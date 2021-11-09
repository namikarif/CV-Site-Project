<?php
require "../../core/function.php";
require "../oauth/token.php";
$functions = new FunctionClass();


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    $_code = 200;
    $json['data'] = 'OPTIONS';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $headers = $functions->getAllHeaders();
        $encode_auth = $headers['Www-Authorization'];
        $encode_auth = substr($encode_auth, 7);
        $decryption = $crypto->decryption($encode_auth);
        $explode_decryption = explode(':', $decryption);
        $logout = $mysqli->query("UPDATE users SET fcm_token = '' WHERE id = " . $explode_decryption[1]);
        if ($logout) {
            $_code = 200;
            $json = 'success';
        } else {
            $_code = 400;
            $json = $mysqli->error;
        }
    }
}
$functions->setHeader($_code);
echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($mysqli);
ob_end_flush();
