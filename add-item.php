<?php
include("config/db.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include("config/db.php");
if(isset($_POST['save'])){

$new_user_email = $_POST['email'];

$name=$_POST['name'];
$layout = $_POST['layout_type'];
$image=$_FILES['image']['name'];
$tmp=$_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"uploads/".$image);
$user_email = $_SESSION['user'];

mysqli_query($conn,"INSERT INTO items(name,image,layout_type,user_email) 
VALUES('$name','$image','$layout','$user_email')");


// EMAIL CODE START
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';*/

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mohammadadnan71773@gmail.com';
    $mail->Password = 'xublaiiapzuopayp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('mohammadadnan71773@gmail.com', 'My Project');
    $mail->addAddress($new_user_email);

    $mail->Subject = 'User Added';
    $mail->Body = 'Your User has been added successfully.';

    $mail->send();
} catch (Exception $e) {
    // do nothing
}
// EMAIL CODE END


header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add User</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:white;
padding:30px;
width:300px;
}

input,button{
width:100%;
padding:10px;
margin:10px 0;
}

</style>

</head>

<body>

<div class="box">

<h2>Add User</h2>

<form method="POST" enctype="multipart/form-data">
<input type="email" name="email" placeholder="User Email" required>
<input type="text" name="name" placeholder="Name" required>

<input type="file" name="image" required>

<button name="save">Save</button>
Layout

<select name="layout_type" required>

<option value="vertical">Vertical</option>

<option value="horizontal">Horizontal</option>

</select>
</form>

</div>

</body>
</html>