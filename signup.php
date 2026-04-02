<?php
include("config/db.php");

if(isset($_POST['signup']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

mysqli_query($conn,"INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");

header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup</title>

<style>

body{
background:#111;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
color:white;
}

.box{
background:#333;
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

<h2>Signup</h2>

<form method="POST">

<input type="text" name="name" placeholder="Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button name="signup">Signup</button>

</form>

</div>

</body>
</html>