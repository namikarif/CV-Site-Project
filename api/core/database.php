<?php
$hosting = "localhost";
$databaseName = "";
$databaseUser = "";
$databasePassword = "";


$mysqli = mysqli_connect($hosting, $databaseUser, $databasePassword);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($mysqli, "utf8");
$mysqli->select_db($databaseName);
$mysqli->options(201, true);
