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
    <title>List of Doctrors</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <!--Navigation bar-->
        <div id="nav-placeholder">
            <script src="navbar\navbar_p.js"></script>
        </div>
        <!--end of Navigation bar-->
    </header>

    <section class="container my-auto pt-4">

        <div>
            <h1 class="text-primary d-flex justify-content-center mt-3 mb-2">List of all Available doctors:
            </h1>
        </div>

        <div>
            <h2 class="text-primary text-muted fw-bold d-flex justify-content-center mt-3 mb-2">Available Specializations:
                <?php
                require_once "database\database.php";
                $query = "SELECT DISTINCT specialization FROM doctortable ORDER BY specialization ASC;";
                $result = mysqli_query($conn, $query);
                $row = array();
                $numOfRows = mysqli_num_rows($result);
                echo "<h4 class=\"text-danger d-flex justify-content-center mt-3 mb-2 \">";
                while ($row = mysqli_fetch_array($result)) {
                    echo $row["specialization"];
                    $numOfRows--;
                    if ($numOfRows > 0) {
                        echo ", ";
                    }
                }
                echo "</h4>"
                ?>
            </h2>
        </div>

        <div class="container-fluid">
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 my-3">
                            <input type="text" name="search" id="search" placeholder="Search by Doctor's name or Specializations" class="form-control" />
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- search field -->
        <script>
            $(document).ready(function() {
                load_data();

                function load_data(query) {
                    $.ajax({
                        url: "database\\search-listof-doctors.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#result').html(data);
                        }
                    });
                }
                $('#search').keyup(function() {
                    var search = $(this).val();
                    if (search != '') {
                        load_data(search);
                    } else {
                        load_data();
                    }
                });
            });
        </script>
    </section>

    <!-- <footer class="footer mt-auto py-3">
        <div id="footer-placeholder" class="">
            <span class="">
                <script>
                    $(function() {
                        $("#footer-placeholder").load("navbar\\footer_p.php");
                    });
                </script>
            </span>
        </div>
    </footer> -->
    <script src="js/bootstrap.js"></script>
</body>

</html>