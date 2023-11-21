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

$id = $user['data']['id']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Doctor</title>
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
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
        <!--end of Navigation bar-->
    </header>

    <main>
        <section class="container">

            <section class="container">
                <div class="row pt-5 justify-content-center">
                    <div class="text-center">
                        <h1 class="text-purple">Welcome, <?= $user['data']['fullname'] ?>!</h1>
                    </div>
                </div>
            </section>

            <section class="container pb-5">
                <h1 class="text-purple fw-bold">Services</h1>
                <h3>These are the services available to you right now!</h3>
                <div class="row">
                    <div class="col-md-6">

                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <i class="fa-solid fa-prescription-bottle fa-4x text-secondary"></i>
                            <div class="ms-3">
                                <h3 class="text-secondary">View Schedule</h3>
                                <h5>See your schedule for today and the later days.</h5>
                                <div>
                                    <a  href="doctor_view_appointments.php" class="btn btn-warning">View Schedule</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <i class="fa-solid fa-capsules fa-4x text-secondary"></i>
                            <div class="ms-3">
                                <h3 class="text-secondary">Appointment History</h3>
                                <h5>See a list of your previous appoinments.</h5>
                                <div>
                                    <a href="doctor_old_appointments.php" class="btn btn-warning">Appointment history</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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