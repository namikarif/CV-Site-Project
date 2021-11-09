<?php

require_once "crypto.php";
$crypto = new CryptoClass(256);

function accessControl($headers)
{
    global $crypto;
    $accessCode = 503;
    $returnArray = [];
    $encode_auth = $headers['Www-Authorization'];
    $encode_auth = substr($encode_auth, 7);
    $decryption = $crypto->decryption($encode_auth);
    $explode_decryption = explode(':', $decryption);
    global $mysqli;
    $checkToken = $mysqli->query("SELECT * FROM token WHERE access_token = '$explode_decryption[0]' AND user_id = '$explode_decryption[1]' AND user_type = '$explode_decryption[2]'");
    if (($checkToken->num_rows) > 0) {
        $accessCode = 200;
    } else {
        $accessCode = 401;
    }
    $returnArray['user_id'] = $explode_decryption[1];
    $returnArray['accessCode'] = $accessCode;
    return $returnArray;
}
