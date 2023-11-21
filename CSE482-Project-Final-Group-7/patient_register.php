<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register as Patient</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/styles.css">
	<script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
</head>

<body>
	<div>
		<div class="bg-primary">
			<nav class="navbar navbar-dark bg-primary navbar-expand-lg bg-body-tertiary container">
				<div class="container-fluid">
					<h1 class="fw-bold display-4 text-warning">Online<span class="text-secondary">Doctor</span></h1>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class=" collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

							<li class="nav-item">
								<a class="nav-link" href="login_page.php">Back to Login</a>
							</li>

						</ul>
					</div>
				</div>
			</nav>

		</div>
	</div>
	<!--Registration Form Starts-->
	<section class="gradient-custom">

		<div class="container py-5 h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-12 col-lg-9 col-xl-7">
					<div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
						<div class="card-body p-4 p-md-5">
							<h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Register</h3>






							<?php
							if (isset($_POST["submit"])) {
								$firstname = $_POST["firstname"];
								$lastname = $_POST["lastname"];
								$fullname= $firstname. ' ' .$lastname;
								$email = $_POST["email"];
								$phonenumber = $_POST["phonenumber"];
								$password = $_POST["password"];
								$repeatpassword = $_POST["repeat_password"];
								$errors = array();
								if (empty($firstname) or empty($lastname) or empty($password) or empty($repeatpassword)) {
									array_push($errors, "All field are required");
								}
								if (strlen($lastname) < 3) {
									array_push($errors, "Last name must be 8 character long");
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
								$sql = " SELECT * FROM patienttable where email= '$email'";// change: table from database 
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
									$sql = "INSERT INTO patienttable (fullname, phone, email, password ) VALUES (?,?,?,?)";
									$stmt = mysqli_stmt_init($conn);
									$prepareStmt = mysqli_stmt_prepare($stmt, $sql);
									if ($prepareStmt) {
										mysqli_stmt_bind_param($stmt, "ssss", $fullname, $phonenumber, $email, $password);
										mysqli_stmt_execute($stmt);
										echo '<script>alert("Account created successfully."); window.location.href="login_page.php";</script>';
									} else {
										die("Something is wrong");
									}
								}
							}
							?>
							<form action="patient_register.php" method="post">

								<div class="row">
									<div class="col-md-6 mb-4">

										<div class="form-outline">
											<input type="text" name="firstname" class="form-control form-control-lg" id="registration-firstName" />
											<label class="form-label" for="registration-firstName">First Name</label>
										</div>

									</div>
									<div class="col-md-6 mb-4">

										<div class="form-outline">
											<input type="text" name="lastname" id="registration-lastName" class="form-control form-control-lg" />
											<label class="form-label" for="registration-lastName">Last Name</label>
										</div>

									</div>
								</div>

								<div class="row">
									<div class="col-md-6 mb-4 d-flex align-items-center">

										<!-- <div class="form-outline datepicker w-100">
											<label for="registration-date-of-birth">Date of Birth:</label>

											<input type="date" id="registration-date-of-birth" name="trip-start" value="mm/dd/yyyy" min="1992-01-01" max="2024-12-31">
										</div> -->

									</div>
									<!-- <div class="col-md-6 mb-4">

										<h6 class="mb-2 pb-1">Gender: </h6>

										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender_radio" id="registration-femaleGender" value="Female" />
											<label class="form-check-label" for="registration-femaleGender">Female</label>
										</div>

										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender_radio" id="registration-maleGender" value="Male" />
											<label class="form-check-label" for="registration-maleGender">Male</label>
										</div>

										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender_radio" id="registration-otherGender" value="Other" />
											<label class="form-check-label" for="registration-otherGender">Other</label>
										</div>

									</div> -->
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

									<input name="submit" id="btn-registration-submit" class="btn btn-primary btn-lg" type="submit" value="Submit" />
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Registration Form Ends-->
	<div id="footer-placeholder"></div>
    <script>
        $(function() {
            $("#footer-placeholder").load("navbar\\footer_p.php");
        });
    </script>
	<script src="js/bootstrap.js"></script>
	<!-- <script src="js/patient_register.js"></script> -->
</body>

</html>