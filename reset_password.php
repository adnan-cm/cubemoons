<?php
include("config/db.php");

$token = $_GET['token'] ?? '';

if($token == ''){
    die("Invalid request");
}

// find user with token uyttr
$query = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$token'");

if(mysqli_num_rows($query) == 0){
    die("Invalid or expired token");
}

$user = mysqli_fetch_assoc($query);

if(isset($_POST['reset'])){

    $new_password = $_POST['password'];

    // hash password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // update password + clear token
    mysqli_query($conn, "UPDATE users SET password='$hashed_password', reset_token=NULL WHERE reset_token='$token'");

    echo "Password reset successful. You can now login.";
    exit();
}
?>

<form method="POST">
    <h2>Reset Password</h2>

    <input type="password" name="password" placeholder="Enter new password" required>

    <button type="submit" name="reset">Update Password</button>
</form>