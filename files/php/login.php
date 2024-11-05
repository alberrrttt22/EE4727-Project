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
if ($result['user_role'] === 'doctor'){
    $fullname = 'Dr '.$result['fullname'];
} else {
    $fullname = $result['fullname'];
}


if (password_verify($password, $hashedPW)){
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['id'] = $result['id'];
    header("Location: ../../dashboard.php");
    exit();
} else {
    header("Location: ../../loginform.php?message=fail");
}
 

