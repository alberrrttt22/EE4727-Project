<?php

include 'connect.php';
session_start();
$email = $_SESSION['email'];
$newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

$query = ("UPDATE users SET hashed_password = '$newPassword' 
    WHERE email = '$email';");

$db->query($query);

header("Location: ../../loginform.php?message=resetted");

session_unset();
session_destroy();
?>