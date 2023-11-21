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
    <title>All your appointments</title>
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

    <section class="container my-5 py-5">

        <div>
            <h1 class="text-primary d-flex justify-content-center my-4 text-decoration-underline fw-bold">List of all your Appointments:
            </h1>
        </div>

        <?php
        require('database\\database.php');
        $pID = $user['id'];
        $query = "SELECT * from appointments where pID = $pID order by completed asc, aptDate asc";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='table-responsive'>";

            echo "<table class='table table-hover table-inverse pb-5'>";

            echo "<tr class='text-primary'>";
            echo "<th><h3 class='fw-bold'>Doctor Name</h3></th>";
            echo "<th><h3 class='fw-bold'>Specialization</h3></th>";
            echo "<th><h3 class='fw-bold'>Date and time</h3></th>";
            echo "<th><h3 class='fw-bold'>Status</h3></th>";

            while ($res = mysqli_fetch_array($result)) {
                $query2 = "SELECT fullname, specialization from doctortable where id =" . $res["dID"] . ";";
                $result2 = mysqli_query($conn, $query2);
                $res2 = mysqli_fetch_row($result2);
                $doctorName = $res2[0];
                $doctorSpec = $res2[1];
                echo "<tr class='text-dark fw-bold'>";
                // echo "<td class='text-dark'>" . $res["dID"] . "</td>";
                echo "<td>" . $doctorName . "</td>";
                echo "<td>" . $doctorSpec . "</td>";
                echo "<td>" . $res["aptDate"] . "</td>";
                if ($res['completed'] == 0) {
                    echo "<td><h4 class='badge bg-warning text-black-50 fw-bold fs-6'>Scheduled</h4></td>";
                } else {
                    echo "<td><h4 class='badge bg-success fw-bold fs-5'>Done</h4></td>";
                }
            };
            echo "</table>";
        } else {
            echo 'No results containing your search terms were found.';
        }
        ?>
    </section>

    <footer class="pt-5 fixed-bottom">
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