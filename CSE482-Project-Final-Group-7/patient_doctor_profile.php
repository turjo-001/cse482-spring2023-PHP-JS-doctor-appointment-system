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

$id = $_POST['view-profile-from-id'];
require_once "database\database.php";
$sql = "SELECT * FROM `doctortable` WHERE id = $id;";
$result_name = mysqli_query($conn, $sql);
$row = array();
while ($row = mysqli_fetch_assoc($result_name)) {
    $doctor_fullname = $row["fullname"];
    $doctor_spec = $row["specialization"];
    $doctor_desc = $row["description"];
    $doctor_number = $row["phone"];
    $doctor_email = $row["email"];
    $doctor_image = $row["imgLoc"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile Page</title>
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
    </header>

    <!-- profile element start -->
    <div class="container mt-4 pb-5">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center mx-0">
                <?php
                if (isset($_POST['view-profile-from-id'])) {
                    if ($doctor_image != NULL) {
                        echo '<img src="images\\' . $doctor_image . '" class="img-fluid border rounded my-auto border-primary rounded-circle h-auto w-auto" />';
                    } else {
                        echo '<img src="images\generic-profile-picture-gender.png" class="img-fluid border rounded my-auto border-primary rounded-circle h-auto w-auto" />';
                    }
                }
                ?>
            </div>


            <div class="col-md-5 mx-4">
                <!--HOME SECTION-->

                <div class="container mt-4">
                    <h1 class="fw-bold" id="container-fullname">
                        <?php
                        if (isset($_POST['view-profile-from-id'])) {
                            echo $doctor_fullname;
                        }
                        ?>
                    </h1>
                    <h3 id="container-specialization" class="text-primary fw-bold">
                        <?php
                        if (isset($_POST['view-profile-from-id'])) {
                            echo $doctor_spec;
                        }
                        ?>
                    </h3>
                </div>

                <!--Doctor's Profile-->
                <div id="about" class="container mt-4">
                    <h2 class="border-bottom border-primary border-3">Doctor's Description</h2>
                    <p class="mt-2">
                        <?php
                        if (isset($_POST['view-profile-from-id'])) {
                            echo $doctor_desc;
                        }
                        ?>
                    </p>

                </div>
                <!--CONTACT SECTION-->
                <div id="contact" class="mt-5">
                    <h2 class="border-bottom border-primary border-3">DOCTOR'S CONTACT DETAILS</h2>
                    <div class="mt-2" style="font-weight: 500;">
                        <p class="text-primary">Doctor's Name:
                            <?php
                            if (isset($_POST['view-profile-from-id'])) {
                                echo $doctor_fullname;
                            }
                            ?>
                        </p>
                        <p class="text-primary">Phone number:
                            <?php
                            if (isset($_POST['view-profile-from-id'])) {
                                echo $doctor_number;
                            }
                            ?>
                        </p>
                        <p class="text-primary">E-mail:
                            <?php
                            if (isset($_POST['view-profile-from-id'])) {
                                echo $doctor_email;
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="container py-2">
                    <a href="patient_listof_doctors.php"><button type="button" class="btn btn-primary">Go back</button></a>
                </div>
            </div>
        </div>
    </div>
    <!-- profile element end -->

    <footer class="pt-5">
        <div id="footer-placeholder"></div>
        <script>
            $(function() {
                $("#footer-placeholder").load("navbar\\footer_p.php");
            });
        </script>
    </footer>

    <script src="js/bootstrap.js"></script>
</body>

</html>