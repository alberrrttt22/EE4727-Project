<?php
session_start();
include 'mail.php';
include 'connect.php';

$patientID = $_SESSION['id'];
$doctorID = $_POST['doctor_id'];
$date = $_POST['date'];
$time = $_POST['time'];


if ($doctorID == 1){
    $query = ("INSERT INTO appointments (patient_id, doctor_id,
    appointment_date, appointment_time) VALUES ('$patientID',
    '$doctorID', '$date','$time');");
    $result = $db->query($query);
    
    header("Location:../../SCHEDULES/TASS.php?message=success");
    mail($example, "XYZ Clinic Appointment details", "Dear patient,
    Your appointment details are as follows: $date at $time with Dr Tan Ah Seng. Please arrive at least 10 minutes before your appointment to avoid any delays. Thank you!", $return);
} else if ($doctorID == 2){
    $query = ("INSERT INTO appointments (patient_id, doctor_id,
    appointment_date, appointment_time) VALUES ('$patientID',
    '$doctorID', '$date','$time');");
    $result = $db->query($query);

    header("Location:../../SCHEDULES/WXMS.php?message=success");
    mail($example, "XYZ Clinic Appointment details", "Dear patient,
    Your appointment details are as follows: $date at $time with Dr Wong Xiao Ming. Please arrive at least 10 minutes before your appointment
    to avoid any delays. Thank you!", $return);
} 

?>