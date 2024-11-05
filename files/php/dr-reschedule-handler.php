<?php
session_start();
include 'connect.php';
include 'mail.php';

$appointment_id = $_POST['appointment_id'];
$doctorID = $_POST['doctor_id'];
$query = ("DELETE FROM appointments 
    WHERE id = '$appointment_id';");

$db->query($query);
if ($doctorID == 1){
    header('Location: ../../dr-dashboard.php');
    mail($example, "XYZ Clinic Appointment Cancellation", "Dear patient,
    Dr Tan Ah Seng has cancelled the following appointment: $date at $time with Dr Tan Ah Seng.", $return);
} else if ($doctorID == 2){
    header('Location: ../../SCHEDULES/WXMS.php');
    mail($example, "XYZ Clinic Appointment Cancellation", "Dear patient,
    Dr Wong Xiao Ming has cancelled the following appointment: $date at $time with Dr Wong Xiao Ming.", $return);
}

?>