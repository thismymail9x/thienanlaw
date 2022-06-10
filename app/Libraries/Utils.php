<?php
namespace App\Libraries;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Utils
{
	/* gen code by md5 */
    public function genCodeByMd5($segment=15, $length=10, $addsOn='')
    {
        $md5_hash = md5(rand(0, 999));
        return substr($md5_hash, $segment, $length).$addsOn;
    }

    /*Use for generate Id on time & random*/
    public function getTimeStampAsId($isMicroTimeNeed = false)
    {
        return date('ymdHis') . rand(10, 99);
    }
    public function getCountPages($countAll, $perPage = ITEM_PERPAGE){
        return ceil($countAll/$perPage);
    }
    public function sendEmail($to, $nameOfTo, $title, $content, $SETTING_EMAIL)
    {

        $mail = new PHPMailer(true);

        $data = [];
        try {

            //Initialize PHP Mailer
            //mail->Debugoutput = [$EMAIL_SETTINGS['EMAIL_DEBUGS'], 'debugLog'];
            $mail->isSMTP();
            $mail->Mailer = $SETTING_EMAIL['PROTOCOL'];
            //Security
            $mail->SMTPAuth = $SETTING_EMAIL['AUTH_BY_PASS'];
            $mail->SMTPDebug = 1;//SMTP::DEBUG_SERVER; // for detailed debug output
            $mail->SMTPSecure = $SETTING_EMAIL['ENCRYPTION_TYPE'];;
            $mail->Host = $SETTING_EMAIL['EMAIL_SERVDER_ADDRESS'];
            $mail->Port = $SETTING_EMAIL['EMAIL_SERVDER_PORT'];
            $mail->Username = $SETTING_EMAIL['USERNAME'];
            $mail->Password = $SETTING_EMAIL['PASSWORD'];
            // Header & Body
            $mail->IsHTML(true);
            $mail->AddAddress($to, $nameOfTo);
            $mail->SetFrom($SETTING_EMAIL['FROM'], $SETTING_EMAIL['FROM_NAME']);
            //$mail->From = "$EMAIL_SETTINGS['FROM']";
            //$mail->FromName = $EMAIL_SETTINGS['FROM_NAME'];
            $mail->Subject = $title;

            //$mail->AddCC("", "");
            //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

            $mail->MsgHTML($content);
            //$mail->Body = $content;
            //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';


            if (!$mail->Send()) {
                $data['error_content'] = 'Can not send an email';
            }
        } catch (Exception $e) {
            $data['error_content'] = $mail->ErrorInfo;
        }
        return $data;
    }

    /**
     * @param $postModel
     * @param $slug
     * @param int $id
     * @return bool|void
     * check post slug isset
     */
    public function checkSlug($postModel,$slug,$id = 0)
    {
        $check_post = $postModel->getFirstByConditions(['slug'=>$slug,'deleted_at'=>null]);
        //register
        if ($id == 0) {
            if (!empty($check_post)) {
                return false;
            } else {
                return true;
            }
        }
        //edit
        if ($id != 0) {
            if (!empty($check_post) && $check_post['post_id'] != $id) {
                return false;
            } else {
                return true;
            }
        }
    }

}