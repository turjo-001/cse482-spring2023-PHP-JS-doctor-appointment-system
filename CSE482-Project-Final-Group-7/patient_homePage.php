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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Patient</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
    <header>

        <!--Navigation bar-->
        <div id="nav-placeholder">
            <script src="navbar\navbar_p.js"></script>
        </div>
        <!--end of Navigation bar-->


        <!-- banner slide show start -->
        <section>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="banner-img-2 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h1 class="display-3 fw-bold text-primary">Need <span class="text-secondary text-decoration-underline">a Doctor?</span>
                                </h1>
                                <p class="text-primary">We offer most expert Doctors</p>
                                <a href="patient_listof_doctors.php" id="btn-carousel-ourdoctors" class="btn btn-primary">Our Doctors</a>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="banner-img-3 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h1 class="display-3 fw-bold text-primary">Need <span class="text-secondary text-decoration-underline">Appointment?<span>
                                </h1>
                                <p class="text-secondary">Most reliable place to get your Appointment Done!</p>
                                <a href="patient_book_appointment.php" class="btn btn-secondary">Book appointment!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- banner slide show end -->
    </header>

    <main>
        <section class="container">
            <div class="row pt-5 justify-content-center">
                <div class="text-center">
                    <h1 class="text-primary">Welcome, <?= $user['fullname'] ?>!</h1>
                </div>
            </div>
        </section>

        <section class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img class="w-50 img-fluid" src="./images/Dr_img.jpg" alt="">
                </div>
                <div class="col-md-6">
                    <h1 class="fw-bold text-primary">Who we are</h1>
                    <p>An appointment booking system that allows patient or any other user to easily book a doctor's appointment online. This is a web-based application that solves the problem of maintaining and arranging appointments depending on the user's preferences or requirements.</p>
                    <ul>
                        <li>We provide various specialized Doctors of diffrent fields.</li>
                        <li>We can assist you to book your appointment online at your preferable time.</li>
                        <li>We are able to successfully connect patients with the Doctors.</li>

                    </ul>
                </div>
            </div>
            <section class="container">
                <h1 class="text-primary fw-bold">Services</h1>
                <p>Find your doctor easily with a minimum of effort. We've kept everything organised for you.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <!-- <i class="fa-solid fa-brain fa-4x text-secondary"></i> -->
                            <i class="fa-solid fa-stethoscope fa-4x text-secondary"></i>
                            <div class="ms-3">
                                <h3 class="text-secondary">Online Doctor</h3>
                                <p>If you are unable to visit the Docors in person, you can avail medical service online via this platform </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center align-items-center shadow-lg p-3 my-3">
                            <i class="fa-solid fa-hand-holding-medical fa-4x text-secondary"></i>
                            <div class="ms-3">
                                <h3 class="text-secondary">24/7 help</h3>
                                <p>We are 24/7 available for providing you with the best medical service both onine and offline</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </section>

    </main>


    <footer class="container my-1 py-1">
        <h1 class="text-primary fw-bold">Contact Us</h1>
        <p>

        </p>
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center my-3">
                    <i class="fa-solid fa-phone fa-2x text-secondary"></i>
                    <div class="ms-3">
                        <h5 class="text-secondary">Help Line</h5>
                        <h6 class="text-primary fw-bold">09610707334
                        </h6>
                    </div>
                </div>
                <div class="d-flex align-items-center my-3">
                    <i class="fa-solid fa-envelope fa-2x text-secondary"></i>
                    <div class="ms-3">
                        <h5 class="text-secondary">Email</h5>
                        <h6 class="text-primary fw-bold">info@OnlineDoctor.com
                        </h6>
                    </div>
                </div>
                <div class="d-flex align-items-center my-3">
                    <i class="fa-solid fa-location-dot fa-2x text-secondary"></i>

                    <div class="ms-3">
                        <h5 class="text-secondary">Address</h5>
                        <h6 class="text-primary fw-bold">18/F, Bir Uttam Qazi Nuruzzaman Sarak, West Panthapath,Dhaka 1205
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="footer-placeholder"></div>
    <script>
        $(function() {
            $("#footer-placeholder").load("navbar\\footer_p.php");
        });
    </script>
    <script src="js/bootstrap.js"></script>
</body>

</html>