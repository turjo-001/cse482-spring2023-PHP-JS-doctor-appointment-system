<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <!-- Nav bar start w/ids -->
        <div>
            <div class="bg-primary">
                <nav class="navbar navbar-dark bg-primary navbar-expand-lg bg-body-tertiary container">
                    <div class="container-fluid">
                        <h1 class="fw-bold display-3 text-warning">Online<span class="text-secondary">Doctor</span></h1>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class=" collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a id="btn-nav-about" class="nav-link" href="patient_homePage.php">Home</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a id="btn-nav-about" class="nav-link" href="#">About</a>
                                </li> -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Services
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a id="btn-nav-logout" class="dropdown-item nav-link text-dark" href="patient_listof_doctors.php">List of Doctors</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a id="btn-nav-logout" class="dropdown-item nav-link text-dark" href="patient_book_appointment.php">Book an appointment</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item nav-link text-dark" href="patient_view_appointment.php">View your appointments</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a id="btn-nav-logout" class="nav-link" href="logout_logic.php"> <span class="text-danger"> Logout
                                        </span> </a>
                                </li>
                                <li class="nav-item">
                                    <!-- <form class="d-flex" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-warning" type="submit">Search</button>
                                    </form> -->
                                    <!-- <div class="search-box">
                                        <input type="text" autocomplete="off" class="form-control rounded" placeholder="Search Doctor" aria-label="Search" aria-describedby="search-addon" />
                                        <div class="result"></div>
                                        <span class="input-group-text border-0 btn-warning" id="search-addon">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div> -->
                                    <!-- <div class="search-box">
                                        <input type="text" autocomplete="off" placeholder="Search Doctor..." />
                                        <div class="result"></div>
                                    </div> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav bar end -->
    </header>
</body>

</html>