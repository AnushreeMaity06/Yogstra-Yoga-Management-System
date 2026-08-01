<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)



require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'anushreemaity06@gmail.com';                     //SMTP username
    $mail->Password   = 'bbgp epko duhz pjxu';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('anushreemaity06@gmail.com', 'Anushree');
    
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
    function send_Mail(){
        global $mail;
        // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress('cclmsexam@gmail.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

    //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('../assets/image/yoga1.jpg', 'yoga1.jpg');    //Optional name

    //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'hii it is for testing.hiiiiiiiiiiiiiii';
        $mail->Body    = 'This is the HTML message body <b>kaise ho susupriya heheheheee😊</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $sendEmail=$mail->send();
    // echo 'Message has been sent';
    return $sendEmail;
    



}
 send_Mail();
?>