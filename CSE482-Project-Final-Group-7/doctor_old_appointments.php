<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login_page.php");
}

$user = $_SESSION['user'];

if ($user['type'] !== 'doctor') {
    header("Location: login_page.php");
    die();
}

$id = $user['data']['id'];

if (isset($_POST["check-done"])) {
    $aptId = $_POST["check-done"];
    require_once 'database\\database.php';
    // Delete the corresponding row from the database table
    $sql = "UPDATE appointments SET completed=1 WHERE aptID = $aptId;";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Appointment status updated successfully Successfully."); window.location.href=window.location.href;</script>';
    } else {
        echo "Error updating record.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your scheduled appointments</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <!--Navigation bar-->
        <div class="bg-purple">
            <nav class="navbar navbar-dark bg-purple navbar-expand-lg bg-body-tertiary container">
                <div class="container-fluid">
                    <h1 class="fw-bold display-4 text-warning">Online<span class="text-secondary">Doctor</span></h1>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class=" collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="doctor_homepage.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="doctor_edit_profile.php">Edit Your Description</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Services
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="doctor_view_appointments.php">View Schedule</a></li>
                                    <li><a class="dropdown-item" href="doctor_old_appointments.php">Appointment History</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a id="btn-nav-logout" class="nav-link" href="logout_logic.php"> <span class="text-danger"> Logout
                                    </span> </a>
                            </li>
                            <!-- <li class="nav-item">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-warning" type="submit">Search</button>
                                </form>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
        <!--end of Navigation bar-->
    </header>

    <main>
    <section class="container my-auto">

<div>
    <h1 class="text-primary d-flex justify-content-center my-4">List of all your scheduled appointments:
    </h1>
</div>

<?php
require('database\\database.php');

$query = "SELECT * from appointments where completed=1 && dID = $id order by aptDate asc";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<div class='table-responsive'>";

    echo "<table class='table table-hover table-inverse'>";

    echo "<tr class='text-primary'>";
    echo "<th><h3 class='fw-bold'>Patient Name</h3></th>";
    echo "<th><h3 class='fw-bold'>Date and time</h3></th>";
    echo "<th><h3 class='fw-bold'>Status</h3></th>";
    echo "<th><h3 class='fw-bold'></h3></th>";

    while ($res = mysqli_fetch_array($result)) {
        $query2 = "SELECT fullname from patienttable where id =" . $res["pID"] . ";";
        $result2 = mysqli_query($conn, $query2);
        $res2 = mysqli_fetch_row($result2);
        $patientName = $res2[0];
        echo "<tr class='text-dark fw-bold'>";
        // echo "<td class='text-dark'>" . $res["dID"] . "</td>";
        echo "<td>" . $patientName . "</td>";
        echo "<td>" . $res["aptDate"] . "</td>";
        if($res['completed'] == 0) {
            echo "<td><h4 class='badge bg-warning text-black-50 fw-bold fs-6'>Scheduled</h4></td>";
        } else {
            echo "<td><h4 class='badge bg-success fw-bold fs-5'>Done</h4></td>";
        }
    };
    echo "</table>";
} else {
    echo 'No results containing your search terms were found.';
}
?>
</section>

    </main>

    <!-- (copyright) footer starts -->
    <div class="navbar fixed-bottom d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-purple">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2023. All rights reserved.
        </div>
        <!-- Copyright -->

        <!-- Right -->
        <div class="d-flex">
            <a href="#!" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        <!-- Right -->
    </div>
    <!-- footer ends -->

    <script src="js/bootstrap.js"></script>
</body>

</html>