<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "cse482_onlinedoctor";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}
