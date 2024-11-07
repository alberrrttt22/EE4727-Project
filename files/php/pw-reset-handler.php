<?php
include 'connect.php';
$email = $_POST['email'];
$token = bin2hex(random_bytes(16)); // Secure random token
$expires = date("Y-m-d H:i:s", strtotime('+5 minutes'));
$query = ("SELECT 1 FROM users WHERE email = '$email';");

$result = $db->query($query);
$return = 'From: user@localhost';
$example = 'user@localhost';

if ($result && $result->num_rows > 0){
    $query = ("INSERT INTO pw_reset(email, reset_token, reset_expires)
    VALUES ('$email', '$token', '$expires');");
    $db->query($query);
    $resetLink = "http://localhost/EE4727-Project/files/php/pw-resetter.php?token=" . urlencode($token) . "&email=" . urlencode($email);
    if (mail($example, "Password Reset", "Click this link to reset your password: $resetLink (Expires in 5 min)", $return)) {
        header('Location: ../../pw-reset.php?message=success');
    }
    exit();
}

header('Location: ../../pw-reset.php?message=fail');

?>