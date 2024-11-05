<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'xyzclinic';

@ $db = new mysqli($servername, $username, $password, $dbname);

$init = ("CREATE TABLE IF NOT EXISTS users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    phone_no INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    user_role ENUM('patient', 'doctor') NOT NULL
    );");

$db->query($init);

$password = 'Password!';
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$init = ("INSERT INTO users(phone_no, email, fullname, hashed_password, user_role)
    SELECT '88112233','tanahseng@xyzclinic.sg', 'Tan Ah Seng', '$hashedPassword', 'doctor'
    WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'tanahseng@xyzclinic.sg');");

$db->query($init);

$init = ("INSERT INTO users(phone_no, email, fullname, hashed_password, user_role)
    SELECT '91234567','wongxiaoming@xyzclinic.sg','Wong Xiao Ming', '$hashedPassword', 'doctor'
    WHERE NOT EXISTS (SELECT 1 FROM users WHERE email='wongxiaoming@xyzclinic.sg');");

$db->query($init);

$init = ("CREATE TABLE IF NOT EXISTS appointments(
    id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    UNIQUE (doctor_id, appointment_date, appointment_time)
    );");

$db->query($init);

$init = ("CREATE TABLE IF NOT EXISTS pw_reset(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255) NOT NULL,
    reset_expires DATETIME NOT NULL
    );");

$db->query($init);
?>

