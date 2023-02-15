
<?php

// include "PHPMailer/src/PHPMailer.php";
// include "PHPMailer/src/Exception.php";
// include "PHPMailer/src/OAuth.php";
// include "PHPMailer/src/POP3.php";
// include "PHPMailer/src/SMTP.php";
use PHPMailer\PHPMailer\PHPmailer;
use PHPMailer\PHPMailer\Exception;


 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_mail($sent_to_mail, $sent_to_fullname, $subject, $content, $option = array()) {
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $config_email['smtp_host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $config_email['smtp_user']; // Enable SMTP authentication                 // SMTP username
        $mail->Password = $config_email['smtp_pass'];;                           // SMTP password
        $mail->SMTPSecure = $config_email['smtp_secure'];;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $config_email['smtp_port'];;                                  // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_mail, $sent_to_fullname);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
     
        // Attachments
        // $mail->addAttachment("images/sac.png");         // Add attachments
        // $mail->addAttachment('images/sac.png', 'thanhvy.png');    // Optional name
     
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     
        $mail->send();
        // echo 'Đã gửi thành công';
        return true;
    } catch (Exception $e) {
        echo 'Gửi không thành công. Chi tiết lỗi: ', $mail->ErrorInfo;
    }
}


?>