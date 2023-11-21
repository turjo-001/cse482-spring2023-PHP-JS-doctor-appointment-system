<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login_page.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
require_once "database.php";
if (isset($_POST['query'])) {
    $query = "SELECT * FROM doctortable WHERE specialization LIKE '{$_POST['query']}%' LIMIT 100";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'>";

        echo "<table class='table table-hover table-inverse'>";

        echo "<tr>";
        echo "<th>Doctor Name</th>";
        echo "<th>Specialization</th>";
        echo "<th class='text-danger'>View Profile</th>";
        echo "</tr>";

        while ($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row["fullname"] . "</td>";
            echo "<td>" . $row["id"] . "</td>";
            echo "</tr>";
            echo "<td><form method='post'><button class='btn btn-danger' type='submit' name='view profile' value='" . $row["id"] . "'</button></form></td>";

        };
        echo "</table>";
    } else {
        echo "
      <div class='alert alert-danger mt-3 text-center' role='alert'>
          No such doctor by this specialization.
        </div>";
    }
}

// require_once "database.php";
// if (isset($_POST['query'])) {
//     $query = "SELECT * FROM doctortable WHERE specialization LIKE '{$_POST['query']}%' LIMIT 100";
//     $result = mysqli_query($conn, $query);
//     if (mysqli_num_rows($result) > 0) {
//         echo "<h5 class=\"test-dark fw-bold\">";
//         while ($res = mysqli_fetch_array($result)) {
//             echo "<a href='patient_doctor_profile.php'>" . $res['fullname'] . ", " .  $res['specialization'] . "</a>" . "<br/>";
//             echo "</a>";
//         };
//         echo "</h5>";
//     } else {
//         echo "
//       <div class='alert alert-danger mt-3 text-center' role='alert'>
//           No such doctor by this specialization.
//         </div>";
//     }
// }
?>