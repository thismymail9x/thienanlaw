<?php


include('Libraries/Utils.php');
$utils = new Utils();
//LAST_ID_CRON = THE LAST SERVER_ID THAT HAS RUN BY CRON-JOB
echo "\nStarted <CronMailSendings.php> on: " . date("Y-m-d H:i:s");
error_reporting(E_ERROR);
echo "\nConnect to database...";
$conn = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);
mysqli_set_charset($conn, 'UTF8');
if ($conn->connect_error) {
    echo "\nFailed: " . $conn->connect_error;
    exit();
}
echo "\nDone";
echo "\n================================================";

/*______________________ bước 1  lấy danh sách mail cần gửi chỉ lấy 10 bản ghi  */
$queryGetData = "SELECT *"
    . " FROM tbl_register_promotions"
    . " WHERE deleted_at IS NULL AND send_email_status = 1"
    . " ORDER BY created_at ASC";
$resultGetData = $conn->query($queryGetData);

//print_r($resultGetUser);
echo "\n+++++++++++++++++++========";
if ($resultGetData->num_rows <= 0) {
    echo "\nDon't exists, try againnnnn!";
    exit();
}


/* duyệt danh sách rồi gửi mail sau đó cập nhật trạng thái của mail đó */
while ($row = $resultGetData->fetch_assoc()) {
    /* bước 2 lấy nội dung gửi mail được setup từ bảng mail, và lấy duy nhất 1 mail có status =1 ( orderby theo updated_at) */
    $queryGetContentMail = "SELECT *"
        . " FROM tbl_mails"
        . " WHERE deleted_at IS NULL AND mail_id = ".$row['template_mail_id']
        . " ORDER BY updated_at DESC"
        . " LIMIT 1";

    $resultGetContentMail = $conn->query($queryGetContentMail);
    if ($resultGetContentMail->num_rows <= 0) {
        echo "\nDon't exists mail active, try againnnnn!";
        exit();
    }
    echo "\nSend mail!";
    $rowMail = $resultGetContentMail->fetch_assoc();
    echo "\n===============";
//    print_r(base64_encode($rowMail['mail_title']));
    $result = $utils->sendEmail($row['email'], "Customer", base64_encode($rowMail['mail_title']) ,base64_encode($rowMail['mail_content']), $SETTING_EMAIL);
    $queryUpdate = "UPDATE tbl_register_promotions" . " SET send_email_status = 0, template_mail_id = NULL" . " WHERE register_promotion_id =" . $row['register_promotion_id'];
    if (isset($result['error_content']) == false) {
        echo"\nFail send mail";
        $queryUpdate = "UPDATE tbl_register_promotions" . " SET send_email_status = 0, template_mail_id = NULL" . " WHERE register_promotion_id =" . $row['register_promotion_id'];
    } else {
        echo $result['error_content'];
    }
    $result = $conn->query($queryUpdate);
    if($result==true){
        echo"\nSuccess";
    }else{
        echo"\nFaied";
    }
    echo "\nSuccess update!";
}

$conn->close();
echo "\nDONE send mail  on: " . date("Y-m-d H:i:s") . "\n";
echo "\n\n\n\n\n\n\n";



/*################################################################*/
/*End-Round*/
