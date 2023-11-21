<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login_page.php");
    die();
}

$user = $_SESSION['user'];

if ($user['type'] !== 'patient') {
    header("Location: login_page.php");
    die();
}

$user = $user['data'];
$patientID = $_SESSION['patientID'];
$selectedDoctorID = $_SESSION['selectedDoctorID'];
$selectedDate = $_SESSION['selectedDate'];
$selectedTime = $_SESSION['selectedTime'];
include 'database\database.php';
$query = "INSERT INTO appointments (pID, dID, aptDate, completed) VALUES ($patientID, $selectedDoctorID, '$selectedDate $selectedTime', 0)";
$result = mysqli_query($conn, $query);

if ($result) {
    echo '<script>alert("Appointment Created Successfully.");</script>';
} else {
    echo '<script>alert("Please enter missing information.")</script>';
}
header('Location: patient_view_appointment.php');
exit();
