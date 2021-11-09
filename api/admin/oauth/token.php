<?php
include_once "../../core/database.php";
include_once "../../core/control.php";
include_once "../../core/crypto.php";
include_once "../../core/function.php";

$functions = new FunctionClass();
$crypto = new CryptoClass();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    $_code = 200;
    $json['data'] = 'OPTIONS';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $type = $_POST['grant_type'];
        $json = [];
        if ($type == 'refresh_token') {
            $refresh_token = $_POST['refresh_token'];
            $access_token = refreshToken($refresh_token);
            $functions->setHeader(201);
            $json = (object)["access_token" => $access_token];
            echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
}

function createToken($userId, $type)
{
    global $mysqli;
    $tokens = [];
    $requestToken = $mysqli->query("SELECT * FROM token WHERE user_id = '$userId' AND user_type = '$type'");
    if (($requestToken->num_rows) > 0) {
        $update = $mysqli->query("UPDATE token SET expire_date = '$expire_date' WHERE user_id = '$userId' AND user_type = '$type'");
        $responseToken = $requestToken->fetch_array(MYSQLI_ASSOC);
        $tokens['refresh_token'] = $responseToken['refresh_token'];
        $tokens['access_token'] = $responseToken['access_token'];
        $tokens['error'] = false;
    } else {
        $refresh_token = randomAlphaNumeric(15);
        $access_token = randomAlphaNumeric(15);
        $insert = $mysqli->query("INSERT INTO token (access_token, user_id, user_type) VALUES('$access_token','$userId','$type')");
        if ($insert) {
            $tokens['refresh_token'] = $refresh_token;
            $tokens['access_token'] = $access_token;
            $tokens['error'] = false;
        } else {
            $tokens['error'] = true;
            $tokens['my'] = $mysqli->error;
        }
    }
    return $tokens;
}

function refreshToken($refresh_token)
{
    global $mysqli;
    global $crypto;
    $token = '';
    $decryption = $crypto->decryption($refresh_token);
    $explode_decryption = explode(':', $decryption);
    $select = $mysqli->query("SELECT * FROM token WHERE refresh_token = '$explode_decryption[0]' AND user_id = '$explode_decryption[1]'");
    if (($select->num_rows) > 0) {
        $token = randomAlphaNumeric(15);
        $create_date = date("Y-m-d H:i:s");
        $timestamp = strtotime($create_date);
        $timestamp = $timestamp + 3600;
        $expire_date = date("Y-m-d H:i:s", $timestamp);
        $update = $mysqli->query("UPDATE token SET access_token = '$token', expire_date = '$expire_date' WHERE user_id = '$explode_decryption[1]'");
        if ($update) {
            $token = $crypto->encryption($token . ":" . $explode_decryption[1]);
        } else {
            $token = '';
        }
    } else {
        $token = '';
    }
    return $token;
}

function randomAlphaNumeric($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $alphaNumeric = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $alphaNumeric .= $characters[mt_rand(0, $max)];
    }
    return $alphaNumeric;
}
