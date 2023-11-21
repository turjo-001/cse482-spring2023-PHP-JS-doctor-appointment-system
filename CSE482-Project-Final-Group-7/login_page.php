<?php
session_start();
if (isset($_SESSION["user"])) {
    $user = $_SESSION['user'];
    if ($user['type'] == 'patient') {
        header("Location: patient_homePage.php");
    } else {
        header("Location: doctor_homepage.php");
    }
    die();
}
require_once "database\database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Online Doctor</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <!-- Nav bar start -->
        <div>
            <div class="bg-primary">
                <nav class="navbar navbar-dark bg-primary navbar-expand-lg bg-body-tertiary container">
                    <div class="container-fluid">
                        <h1 class="fw-bold display-4 text-warning">Online<span class="text-secondary">Doctor</span></h1>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class=" collapse navbar-collapse" id="navbarSupportedContent">

                        </div>
                    </div>
                </nav>

            </div>
        </div>
        <!-- Nav bar end -->
    </header>

    <!-- login form start -->
    <div class="container row py-3 offset-xl-0 offset-sm-1">
        <?php
        if (isset($_POST["login"])) {
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = $_POST["password"];
            $sql1 = "SELECT * FROM patienttable WHERE email = '$email'";
            $result1 = mysqli_query($conn, $sql1);
            $sql2 = "SELECT * FROM doctortable WHERE email = '$email'";
            $result2 = mysqli_query($conn, $sql2);
            $sql3 = "SELECT * FROM admin WHERE email = '$email'";
            $result3 = mysqli_query($conn, $sql3);
            $user1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
            $user2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $user3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
            if ($user1) {
                $user = $user1;
                if (strcmp($user['password'], $password) == 0) {
                    unset($user['password']);
                    $_SESSION["user"] = [
                        "type" => "patient",
                        "data" => $user
                    ];
                    header("Location: patient_homePage.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } elseif ($user2) {
                $user = $user2;
                if (strcmp($user['password'], $password) == 0) {
                    unset($user['password']);
                    $_SESSION["user"] = [
                        "type" => "doctor",
                        "data" => $user
                    ];
                    header("Location: doctor_homepage.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } elseif ($user3) {
                $user = $user3;
                if (strcmp($user['password'], $password) == 0) {
                    unset($user['password']);
                    $_SESSION["user"] = [
                        "type" => "admin",
                        "data" => $user
                    ];
                    header("Location: admin_homePage.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <section class="h-75">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="images\Dr_img.jpg" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="login_page.php" method="post">
                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-5">
                                <p class="lead fw-normal mb-0 me-3 fw-bold">Log In or Sign Up to use our website!</p>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" />
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                    <label class="form-check-label" for="form2Example3">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#!" class="text-body">Forgot password?</a>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <div class="btn btn-primary btn-lg">
                                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                                </div>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" id="btn-register" class="link-danger">Register</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- login form end -->

    <!-- (copyright) footer starts -->
    <footer class="pt-5">
        <div id="footer-placeholder"></div>
        <script>
            $(function() {
                $("#footer-placeholder").load("navbar\\footer_p.php");
            });
        </script>
    </footer>
    <script src="js/bootstrap.js"></script>
    <script src="js/login.js"></script>
</body>

</html>