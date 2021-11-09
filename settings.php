<?php
date_default_timezone_set('Europe/Istanbul');
$hosting = "localhost";
$dbname = "tufineco_blog";
$dbuser = "tufineco_blog";
$dbpass = "namka0151";
$conn = @mysql_connect("$hosting", "$dbuser", "$dbpass");
$veritabani = @mysql_select_db("$dbname");
mysql_query("SET NAMES 'utf-8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

if($conn)
{
$siteAyar = mysql_fetch_assoc(mysql_query("select * from SITE_AYARLARI"));
$genelBilgi = mysql_fetch_assoc(mysql_query("select * from GENEL_BILGILER"));
}
else
{
    echo 'Veritabanina Baglanilamadi.';
    exit;
}