<?php
require('database.php');
$return = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT id, fullname, specialization FROM doctortable
	where specialization LIKE '%" . $search . "%'
    OR fullname LIKE '%" . $search . "%'
    order by specialization ASC";
} else {
    $query = "SELECT id, fullname, specialization FROM doctortable order by specialization ASC";
}
$result = mysqli_query($conn, $query);
$row1 = array();
// $iteration = 0;
// $arrayOfLoadedIds = array();
if (mysqli_num_rows($result) > 0) {
    echo "<div class='table-responsive'>";

        echo "<table class='table table-hover table-inverse'>";

        echo "<tr>";
        echo "<th><h3 class='fw-bold'>Doctor Name</h3></th>";
        echo "<th><h3 class='fw-bold'>Specialization</h3></th>";
        echo "<th><h3 class='fw-bold text-primary'>View Profile</h3></th>";
        echo "</tr>";

        while ($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td class='text-dark'>" . $res["fullname"] . "</td>";
            echo "<td>" . $res["specialization"] . "</td>";
            echo "<td><form action='patient_doctor_profile.php' method='post'><button class='btn btn-primary' type='submit' name='view-profile-from-id' value='" . $res["id"] . "'>View Profile</button></form></td>";
            echo "</tr>";
        };
        echo "</table>";
} else {
    echo 'No results containing your search terms were found.';
}