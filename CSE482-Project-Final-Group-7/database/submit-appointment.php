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

if (isset($_POST['submit']))
echo 'Selected specialization: ' . $_POST['selected-specialization'] . '<br>';
echo 'Selected Doctor: ' . $_POST['selected-doctor'] . '<br>';
echo 'patient id: ' . $user['id'];
$patientID = $user['id'];
include 'database\database.php';
$selectedDoctorName = $_POST['selectedDoctor'];
$selectedDate = $_POST['chosenDate'];
$selectedTime = $_POST['chosenTime'];
$query = "SELECT id FROM doctortable WHERE fullname = '$selectedDoctorName';";
$result = mysqli_query($conn, $query);
$selectedDoctorID;
while ($row = mysqli_fetch_assoc($result)) {
    $selectedDoctorID = $row['id'];
}
// echo '<br>'. $selectedDoctorID . '<br>'. $selectedDate . '<br>'. $selectedTime;
$query = "INSERT INTO appointments (pID, dID, aptDate) VALUES ($patientID, $selectedDoctorID, '$selectedDate $selectedTime')";
$result = mysqli_query($conn, $query);

if ($result) {
    echo '<script>alert("Appointment Created Successfully.")</script>';
} else {
    echo '<script>alert("Please enter missing information.")</script>';
}
    // }
