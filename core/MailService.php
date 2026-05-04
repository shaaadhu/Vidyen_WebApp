<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require __DIR__ . '/../vendor/autoload.php';
    
class MailService {

    public function sendMail($to, $name, $subject, $body) {

        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail->Host = Env::get('MAIL_HOST');
        $mail->Port = Env::get('MAIL_PORT');
        $mail->SMTPAuth = true;
        $mail->Username = Env::get('MAIL_USERNAME');
        $mail->Password = Env::get('MAIL_PASSWORD');

        $mail->setFrom(Env::get('MAIL_FROM'), Env::get('MAIL_FROM_NAME'));
        $mail->addAddress($to, $name);

        $mail->Subject = $subject;
        $mail->msgHTML($body);

        return $mail->send();
    }
}