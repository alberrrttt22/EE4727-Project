<?php

include 'connect.php';
$fullname = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$check = ("SELECT 1 FROM users WHERE email = '$email';");
$result = $db->query($check);

if ($result && $result->num_rows>0){
    header('Location: ../../signupform.php?message=fail');
    exit();
}

$query = ("INSERT INTO users (fullname, phone_no, email, hashed_password, user_role )
    VALUES ('$fullname', '$phone', '$email', '$hashedPassword','patient')
    ;");

$db->query($query);
header('Location: ../../signupform.php?message=success');

?>