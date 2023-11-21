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

    <?php
    require_once 'database\\database.php';
    $query = "SELECT description FROM doctortable where id = $id;";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $currentDesc =  $row['description'];
    trim($currentDesc);
    ?>

    <main>
        <div class="container my-5 py-5">
            <div class="mb-3">
                <form action="" method="post">
                    <label for="" class="form-label fs-5 fw-bold mb-3">Edit your current description: </label>

                    <textarea class="form-control border-3 clearfix" id="" name="description" rows="3" value=""><?php echo $currentDesc ?></textarea>
                    <input name="update" id="" class="btn btn-purple my-5" type="submit" value="Update Description"/>
                </form>

                <?php
                if (isset($_POST["update"])) {
                    require_once 'database\\database.php';
                    $newDesc = $_POST["description"];
                    $query = "UPDATE doctortable set description = '$newDesc' WHERE id = $id;";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        echo '<script>alert("Description Updated Successfully."); window.location.href=window.location.href;</script>';
                    } else {
                        echo "Error updating record.";
                    }
                }
                ?>
            </div>
        </div>
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