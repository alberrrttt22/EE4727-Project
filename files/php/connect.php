<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'xyzclinic';

@ $db = new mysqli($servername, $username, $password, $dbname);

$init = ("CREATE TABLE IF NOT EXISTS users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL
    );");

$db->query($init);


?>

