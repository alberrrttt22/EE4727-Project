<?php
session_start();
include 'connect.php';
include 'mail.php';

$doctorID = $_POST['doctor_id'];
$date = $_POST['date'];
$time = $_POST['time'];

$query = ("DELETE FROM appointments 
    WHERE doctor_id = '$doctorID' AND
    appointment_date = '$date' AND appointment_time = '$time';");

$db->query($query);
if ($doctorID == 1){
    header('Location: ../../SCHEDULES/TASS.php');
    mail($example, "XYZ Clinic Appointment Cancellation", "Dear patient,
    You have cancelled the following appointment: $date at $time with Dr Tan Ah Seng.", $return);
} else if ($doctorID == 2){
    header('Location: ../../SCHEDULES/WXMS.php');
    mail($example, "XYZ Clinic Appointment Cancellation", "Dear patient,
    You have cancelled the following appointment: $date at $time with Dr Wong Xiao Ming.", $return);
}

?>