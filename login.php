<?php
session_start();
include("config/db.php");

if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];

$q=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user=mysqli_fetch_assoc($q);

if($user && password_verify($password,$user['password']))
{
$_SESSION['user'] = $row['email'];
$_SESSION['role'] = $row['role'];
$_SESSION['user']=$user['email'];
$_SESSION['role']=$user['role'];

header("Location: dashboard.php");
exit();
}
else
{
$msg="Invalid Login";
}
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<style>

body{
font-family:Arial;
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
margin:0;
}

.box{
background:white;
padding:35px;
width:320px;
border-radius:8px;
box-shadow:0 5px 20px rgba(0,0,0,0.3);
}

h2{
text-align:center;
margin-bottom:20px;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
}

button{
width:100%;
padding:12px;
background:#2c5364;
border:none;
color:white;
border-radius:5px;
cursor:pointer;
font-size:16px;
}

button:hover{
background:#1e3d4f;
}

.links{
display:flex;
justify-content:space-between;
margin-top:10px;
}

.links a{
text-decoration:none;
font-size:14px;
color:#2c5364;
font-weight:bold;
}

</style>

</head>

<body>

<div class="box">

<h2>Login</h2>

<?php if(isset($msg)) echo "<p style='color:red'>$msg</p>"; ?>

<form method="POST">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button name="login">Login</button>

</form>

<div class="links">

<a href="signup.php">Signup</a>

<a href="forgot_password.php">Forgot Password?</a>
</div>

</div>

</body>
</html>