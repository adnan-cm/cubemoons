<?php
include("config/db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])){

    $email = $_POST['email'];

    // check user exists
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) > 0){

        // generate token
        $token = bin2hex(random_bytes(50));

        // save token in database
        mysqli_query($conn, "UPDATE users SET reset_token='$token' WHERE email='$email'");

        // reset link
        $reset_link = "http://localhost/cubemoons/reset_password.php?token=$token";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mohammadadnan71773@gmail.com';
            $mail->Password = 'xublaiiapzuopayp';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mohammadadnan71773@gmail.com', 'CubeMoons');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body = "Click this link to reset password: <a href='$reset_link'>$reset_link</a>";

            $mail->send();
            echo "Reset link sent to your email";

        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    } else {
        echo "Email not found";
    }
}
?>