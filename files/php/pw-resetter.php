<?php
session_start();
include 'connect.php';

$token = $_GET['token'];
$email = $_GET['email'];

$query = ("SELECT reset_expires 
    FROM pw_reset 
    WHERE reset_token = '$token'
    AND email = '$email';");

$result = $db->query($query);
$expires = $result->fetch_assoc();

if ($expires && new DateTime() < new DateTime($expires['reset_expires'])){
    header('Location: ../../pw-reset2.php');
    $_SESSION['email'] = $email;
} else {
    header('Location: ../../pw-reset.php?message=expired');
}

?>