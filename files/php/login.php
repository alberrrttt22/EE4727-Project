<?php
session_start();
include 'connect.php';

$email = $_POST["email"];
$password = $_POST['password'];

$query = ("SELECT * FROM users
    WHERE email = '$email';");

$result = $db->query($query);
$result = $result->fetch_assoc();
$hashedPW = $result['hashed_password'];
$fullname = $result['fullname'];

if (password_verify($password, $hashedPW)){
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['fullname'] = $fullname;
    
    header("Location: ../../dashboard.html");
    exit();
} else {
    header("Location: ../../loginform.php?message=fail");
}
 

