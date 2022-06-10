<?php
require_once __DIR__ . '/SftpConnection.php';
require_once __DIR__ . '/Configs/Config.php';

require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Utils
{

    /**
     * send mail
     */
    public function sendEmail($to, $nameOfTo, $title, $content, $SETTING_EMAIL)
    {

        $mail = new PHPMailer(true);

        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';


        $data = [];
        try {

            //Initialize PHP Mailer
            //mail->Debugoutput = [$EMAIL_SETTINGS['EMAIL_DEBUGS'], 'debugLog'];
            $mail->isSMTP();
            $mail->Mailer = $SETTING_EMAIL['PROTOCOL'];
            //Security
            $mail->SMTPAuth = $SETTING_EMAIL['AUTH_BY_PASS'];
//            hiển thị log send mail
            $mail->SMTPDebug;//SMTP::DEBUG_SERVER; // for detailed debug output

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
            $mail->Subject = base64_decode($title);

            //$mail->AddCC("", "");
            //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to
            $mail->MsgHTML(base64_decode($content));
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
}