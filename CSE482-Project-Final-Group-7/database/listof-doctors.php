<?php
include 'database.php';
$stmt = $DB->prepare("SELECT * FROM doctortable WHERE specialization = :department");
$stmt->bindParam(":department", $_POST['department']);
$stmt->execute();
$data_doctors = $stmt->fetchAll();
?>
<option>Select Doctors</option>
<?php foreach ($data_doctors as $doctor) : ?>
    <option value="<?php echo $doctor['name']; ?>"><?php echo $doctor['name']; ?></option>
<?php endforeach; ?>