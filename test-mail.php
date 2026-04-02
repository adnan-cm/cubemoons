<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mohammadadnan71773@gmail.com'; // your gmail
    $mail->Password = 'xublaiiapzuopayp';   // app password (no spaces)
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('mohammadadnan71773@gmail.com', 'My Project');
    $mail->addAddress('mohammadadnan71773@gmail.com'); // where you want to receive

    $mail->Subject = 'Test Email';
    $mail->Body    = 'Email is working successfully!';

    $mail->send();
    echo "Email Sent Successfully";
} catch (Exception $e) {
    echo "Error: " . $mail->ErrorInfo;
}
