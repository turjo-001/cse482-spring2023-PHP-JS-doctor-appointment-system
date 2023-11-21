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


<?php
// Check if delete button is clicked
include_once 'database\\database.php';
if (isset($_POST["delete"])) {
    $id = $_POST["delete"];

    // Delete the corresponding row from the database table
    $sql = "DELETE FROM doctortable WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Doctor record deleted Successfully."); window.location.href=window.location.href;</script>';
    } else {
        echo "Error deleting record.";
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Table Information</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>
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
    </header>

    <div class="container">
        <h1 class="">Patient Table Information</h1>
        <div>
            <?php
            include_once 'database\\database.php';
            // Retrieve data from the database table
            $sql = "SELECT * FROM doctortable";
            $result = $conn->query($sql);
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                echo "<div class='table-responsive'>";

                echo "<table class='table table-hover table-inverse'>";

                echo "<tr>";
                echo "<th>Doctor ID</th>";
                echo "<th>Full Name</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Email Address</th>";
                echo "<th>Specialization</th>";
                echo "<th class='text-danger'>Delete user?</th>";
                echo "</tr>";

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["fullname"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["specialization"] . "</td>";
                        echo "<td><form method='post'><button class='btn btn-danger' type='submit' name='delete' value='" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</button></form></td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "0 results";
            }

            // Close the connection
            $conn->close();
            ?>
        </div>


    </div>
</body>

</html>