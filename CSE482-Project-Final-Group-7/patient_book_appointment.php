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
    <title>Book an appointment</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/c83715e26a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</head>

<body>


    <!--Navigation bar-->
    <div id="nav-placeholder">
        <script src="navbar\navbar_p.js"></script>
    </div>
    <!--end of Navigation bar-->

    <div>
        <h1 class="text-primary d-flex justify-content-center my-2 pt-4 text-decoration-underline fw-bold">Book an Appointment</h1>
    </div>


    <section class="container my-5 py-5">
        <form action="" method="post">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col">
                    <div>
                        <h3 class="d-flex justify-content-center text-primary mt-4">Select a specialization</h3>
                    </div>
                    <!-- specialization dropdown -->
                    <div class="input-group d-flex justify-content-center my-2">
                        <select class="form-select-lg rounded-2" id="selected-specialization" name="selected-specialization" required>
                            <option value="">Select a specialization</option>
                            <?php
                            include_once 'database\database.php';
                            $query = "SELECT DISTINCT specialization FROM doctortable ORDER BY specialization";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['specialization'] . '">' . $row['specialization'] . '</option>';
                                }
                            } else {
                                echo '<option value="">Specialization not available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <h3 class="d-flex justify-content-center text-primary mt-4">Select a Doctor</h3>
                    </div>
                    <!-- doctor name dropdown -->
                    <div class="input-group d-flex justify-content-center my-2">
                        <select class="form-select-lg rounded-2" id="selected-doctor" name="selected-doctor" required>
                            <option value="">Select a Doctor</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <div>
                            <h3 class="d-flex justify-content-center text-primary mt-4">Select a Date</h3>
                        </div>
                        <p class="form-select-lg input-group d-flex justify-content-center my-2"><input type="text" id="datepicker" name="chosen-date" autocomplete="off" required></p>
                    </div>
                    <div>
                        <div>
                            <h3 class="d-flex justify-content-center text-primary mt-4">Select a Time</h3>
                        </div>
                        <p class="form-select-lg input-group d-flex justify-content-center my-2"><input type="text" id="timepicker" name="chosen-time" autocomplete="off" required></p>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group d-flex justify-content-center my-5">
                        <input class="btn btn-primary btn-lg rounded-3" type="submit" name="submit-book-appointment" value="Book Appointment" />
                        <input class="mt-1 btn btn-outline-success btn-lg rounded-3 disabled fw-bold" value="Price: $50"/>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <footer class="pt-5">
    <div id="footer-placeholder"></div>
        <script>
            $(function() {
                $("#footer-placeholder").load("navbar\\footer_p.php");
            });
        </script>
    </footer>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 1, //make appointments
                maxDate: 7,
                beforeShowDay: noFridays
            });
        });

        function noFridays(date) {
            if (date.getDay() === 5)
                return [false, "closed", "Closed on Friday"]
            else
                return [true, "", ""]
        }
    </script>

    <script>
        $('#timepicker').timepicker({
            timeFormat: 'hh:mm:ss p',
            interval: 30,
            minTime: '14:00:00',
            maxTime: '21:00:00',
            startTime: '13:00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#selected-specialization').on('change', function() {
                var spec = $(this).val();
                if (spec) {
                    $.ajax({
                        type: 'POST',
                        url: 'database\\booking-ajax.php',
                        data: 'specialization=' + spec,
                        success: function(html) {
                            $('#selected-doctor').html(html);
                        }
                    });
                } else {
                    $('#selected-doctor').html('<option value="">Select a Doctor</option>');
                }
            });
        });
    </script>

    <?php
    if (isset($_POST['submit-book-appointment'])) {
        $patientID = $user['id'];
        include 'database\database.php';
        $selectedDoctorName = mysqli_real_escape_string($conn, $_POST['selected-doctor']);
        $selectedDate = mysqli_real_escape_string($conn, $_POST['chosen-date']);
        $selectedTime = mysqli_real_escape_string($conn, $_POST['chosen-time']);
        $query = "SELECT id FROM doctortable WHERE fullname = '$selectedDoctorName';";
        $result = mysqli_query($conn, $query);
        $selectedDoctorID;
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $selectedDoctorID = $row['id'];
            }
            $query = "SELECT * FROM appointments WHERE dID = $selectedDoctorID AND aptDate = '$selectedDate $selectedTime' AND completed = 0;";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                echo '<script>alert("Appointment slot already taken by someone else.")</script>';
            } else {
                $_SESSION['patientID'] = $patientID;
                $_SESSION['selectedDoctorID'] = $selectedDoctorID;
                $_SESSION['selectedDate'] = $selectedDate;
                $_SESSION['selectedTime'] = $selectedTime;
                echo '<script>window.location.replace("patient_payment_page.php");</script>';
            }
        }
    }
    ?>

    <script src="js/bootstrap.js"></script>
</body>

</html>