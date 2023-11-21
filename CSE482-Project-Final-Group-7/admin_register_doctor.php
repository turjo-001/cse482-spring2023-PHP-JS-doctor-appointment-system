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
  <title>Register Doctor</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
</head>

<body>
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
                                    <a href="admin_access_doctor_info.php" class="nav-item nav-link active" id="anchor-nav-home">Doctor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="admin_access_patient_info.php" class="nav-item nav-link active" id="anchor-nav-home">Patient</a>
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
  <!--Registration Form Starts-->
  <section class="gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Register a new Doctor</h3>



              <?php
              if (isset($_POST["submit"])) {
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $fullname = $firstname . ' ' . $lastname;
                $specialization = $_POST["specialization"];
                $imgLoc = $_POST["img-location"];
                $email = $_POST["email"];
                $phonenumber = $_POST["phonenumber"];
                $password = $_POST["password"];
                $repeatpassword = $_POST["repeat_password"];
                $errors = array();
                if (empty($firstname) or empty($lastname) or empty($specialization) or empty($password) or empty($repeatpassword)) {
                  array_push($errors, "All field are required");
                }
                if (strlen($firstname) < 3) {
                  array_push($errors, "First name must be 8 character long");
                }
                if (strlen($lastname) < 3) {
                  array_push($errors, "Last name must be 8 character long");
                }


                if (strlen($specialization < 5)) {
                  array_push($errors, " Specialization field is required");
                }


                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 8) {
                  array_push($errors, "Password must be 8 character long");
                }
                if ($password !== $repeatpassword) {
                  array_push($errors, "Password does not match");
                }

                require_once "database\database.php";
                $sql = " SELECT * FROM doctortable where email= '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                  array_push($errors, "Email already exist");
                }



                if (count($errors) > 0) {
                  foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                  }
                } else {
                  //db add
                  $sql = "INSERT INTO doctortable (fullname, phone, specialization, email, password, imgLoc) VALUES (?,?,?,?,?,?)";
                  $stmt = mysqli_stmt_init($conn);
                  $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                  if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $phonenumber, $specialization, $email, $password, $imgLoc);
                    mysqli_stmt_execute($stmt);
                    echo '<script>alert("Account created successfully."); window.location.href="admin_homePage.php";</script>';
                  } else {
                    die("Something is wrong");
                  }
                }
              }

              ?>




              <form action="admin_register_doctor.php" method="post">

                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="registration-firstName" name="firstname" class="form-control form-control-lg" />
                      <label class="form-label" for="registration-firstName">First Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="registration-lastName" name="lastname" class="form-control form-control-lg" />
                      <label class="form-label" for="registration-lastName">Last Name</label>
                    </div>

                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                      <label class="form-label" for="registration-specialization">Specialization:</label>
                      <input id="registration-specialization" name="specialization" rows="4" cols="40"> </input>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                      <label for="img">Select image:</label>
                      <input type="file" id="img" name="img-location" accept="image/.jpg">
                    </div>

                  </div>
                </div>



                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" name="email" id="registration-emailAddress" class="form-control form-control-lg" />
                      <label class="form-label" for="registration-emailAddress">Email</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="tel" name="phonenumber" id="registration-phoneNumber" class="form-control form-control-lg" />
                      <label class="form-label" for="registration-phoneNumber">Phone Number</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="password" name="password" id="registration-password" class="form-control form-control-lg" />
                      <label class="form-label" for="registration-password">Enter Password:</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="password" name="repeat_password" id="registration-new-password" class="form-control form-control-lg" />
                      <label class="form-label" for="registration-new-password">Re-Enter Password:</label>
                    </div>

                  </div>
                </div>

                <div class="mt-4 pt-2">

                  <input id="btn-registration-submit" name="submit" class="btn btn-primary btn-lg" type="submit" value="Submit" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Registration Form Ends-->
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
  <!-- <script src="js/admin_register_doctor.js"></script> -->
</body>

</html>