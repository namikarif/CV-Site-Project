<?php
require "../../core/control.php";
require "../../core/database.php";
require "../../core/function.php";
require_once "../../core/crypto.php";
require "token.php";

$crypto = new CryptoClass(256);
$functions = new FunctionClass();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    $_code = 200;
    $json['data'] = 'OPTIONS';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postObject = json_decode(file_get_contents("php://input"));
        $email = strtolower($mysqli->real_escape_string(strtolower($postObject->email)));
        $current_lang = $postObject->language ? $postObject->language : 'az';
        $selectActivationCode = $mysqli->query("SELECT * FROM activation_code WHERE user_mail = '$email' AND type = 'forgot'");
        $activationCodeDetail = $selectActivationCode->fetch_array();
        $activationCodeNum = $selectActivationCode->num_rows;
        $activationCode = $functions->randomNumber(6);
        if ($activationCodeNum < 1) {
            $insertCode = $mysqli->query("INSERT INTO activation_code(code,user_mail,type) VALUES ('$activationCode','$email','forgot')");
        } else {
            $insertCode = $mysqli->query("UPDATE activation_code SET code = '$activationCode', type = 'forgot' WHERE user_mail = '$email' AND type = 'forgot'");
        }

        if ($insertCode) {
            $successSendMail = $functions->makeForgotPasswordMail('', $email, '', $activationCode, 'forgot', $current_lang);
            if ($successSendMail) {
                $_code = 201;
                $json['data'] = 'send_approved_mail_to_mail_address';
            } else {
                $_code = 400;
                $json = $functions->handleError("mail_not_sent");
                $delete = $mysqli->query("DELETE FROM activation_code WHERE user_mail='$email'");
            }
        } else {
            $_code = 400;
            $json = $functions->handleError('some_error_happen');
        }
    }
}

$functions->setHeader($_code);
echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($mysqli);
