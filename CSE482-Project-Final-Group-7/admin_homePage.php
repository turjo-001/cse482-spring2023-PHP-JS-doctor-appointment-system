<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login_page.php");
    die();
}

$user = $_SESSION['user'];

if ($user['type'] !== 'admin') {
    header("Location: login_page.php");
    die();
}

$user = $user['data'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Admin</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <!-- Nav bar start -->
        <div>
            <div class="bg-dark bg-gradient">
                <nav class="navbar navbar-dark bg-dark bg-gradient navbar-expand-lg bg-body-tertiary container">
                    <div class="container-fluid">
                        <h1 class="fw-bold display-4 text-warning">Online<span class="text-secondary">Doctor</span></h1>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class=" collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a href="admin_homePage.php" class="nav-item nav-link active" id="anchor-nav-home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout_logic.php"> <span class="text-danger"> Logout </span> </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
        <!-- Nav bar end -->
    </header>

    <main>

        <section class="container bg-secondary-subtle my-5 py-5">
            <section class="container bg-secondary-subtle">
                <h1 class="text-primary fw-bold">Admin's Dashboard</h1>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <!-- <i class="fa-solid fa-brain fa-4x text-secondary"></i> -->
                            <i class="fa-solid fa-stethoscope fa-3x text-purple"></i>
                            <div class="ms-3">
                                <h3 class="text-muted">Register new doctor</h3>
                                <a href="admin_register_doctor.php"><button id="btn-registration" type="button" class="btn btn-warning">Register</button></a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <i class="fa-solid fa-bed fa-3x text-primary"></i>
                            <div class="ms-3">
                                <h3 class="text-muted">All Patient List</h3>
                                <a href="admin_access_patient_info.php"><button type="button" class="btn btn-warning">Check</button></a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <i class="fa-solid fa-stethoscope fa-3x text-purple"></i>
                            <div class="ms-3">
                                <h3 class="text-muted">All Doctor List</h3>
                                <a href="admin_access_doctor_info.php"><button type="button" class="btn btn-warning">Check</button></a>
                            </div>
                        </div>



                    </div>
                </div>
            </section>


        </section>

    </main>


    <footer class="container my-5 py-5">

    </footer>
    <!-- (copyright) footer starts -->
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-dark bg-gradient">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
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
    <!-- <script src="js/admin_homepage.js"></script> -->
</body>

</html>