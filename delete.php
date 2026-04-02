<?php
session_start();
include("config/db.php");

$id = $_GET['id'];

if($_SESSION['role'] == 'admin'){
    // admin can delete anything
    mysqli_query($conn, "DELETE FROM items WHERE id='$id'");
} else {
    // user can delete only their own data
    $user_email = $_SESSION['user'];
    mysqli_query($conn, "DELETE FROM items 
    WHERE id='$id' AND user_email='$user_email'");
}

header("Location: dashboard.php");
?>