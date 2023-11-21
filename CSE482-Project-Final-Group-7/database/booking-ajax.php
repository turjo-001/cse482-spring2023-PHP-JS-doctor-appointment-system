<?php
// Include the database config file 
include_once 'database.php';

if (!empty($_POST['specialization'])) {
    // Fetch doctor name based on the specialization
    $selectedSpec = mysqli_real_escape_string($conn, $_POST['specialization']);
    $query = "SELECT * FROM doctortable WHERE specialization='$selectedSpec'";
    // $result = $conn->query($query);
    $result = mysqli_query($conn, $query);

    // Generate HTML of Doctor name options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select a Doctor</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['fullname'] . '">' . $row['fullname'] . '</option>';
        }
    } else {
        echo '<option value="">No Doctor available</option>';
    }
}
?>

<html>
    
</html>
