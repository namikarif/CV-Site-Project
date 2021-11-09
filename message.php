<?php
require 'database.php';
require 'functions.php';

if($SiteSetting['Message'] == 0)
{
    echo '3';
    exit;
}
if($_POST)
{
    $name = firewall($_POST['name']);
    $telephone = firewall($_POST['telephone']);
    $email = firewall($_POST['email']);
    $message = firewall($_POST['message']);
    if($message && $name && $telephone && $email)
    {
        $ip =  $_SERVER['REMOTE_ADDR'];
        mysqliQuery("INSERT INTO INBOX (Name, EMail, Phone, Message, Status, IP, Date) values ('$name', '$email', '$telephone', '$message', 1, '$ip',now())");
        echo '1';
    }
    else
        echo '2';
}
else
    echo '2';