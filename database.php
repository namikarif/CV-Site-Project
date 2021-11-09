<?php
date_default_timezone_set('Europe/Istanbul');

$hosting = "localhost";
$databaseName = "";
$databaseUser = "";
$databasePassword = "";


$mysqli = mysqli_connect($hosting, $databaseUser, $databasePassword);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($mysqli,"utf8");
$mysqli->set_charset('utf8');
$mysqli->query("SET collation_connection = utf8_czech_ci");
$mysqli->select_db($databaseName);
//$mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, TRUE);

$SiteSettingQuery = $mysqli->query("SELECT * FROM SITE_SETTINGS");
$SiteSetting = $SiteSettingQuery->fetch_array(MYSQLI_ASSOC);
$GeneralInformationQuery = $mysqli->query("SELECT * FROM GENERAL_INFORMATION");
$GeneralInformation = $GeneralInformationQuery->fetch_array(MYSQLI_ASSOC);
