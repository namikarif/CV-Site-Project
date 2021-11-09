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
        $email = $mysqli->real_escape_string(strtolower($postObject->email));
        $password = $postObject->password;
        $activation_code = $postObject->activation_code;
        $current_lang = $postObject->language ? $postObject->language : 'az';
        if ($email !== '' || $password !== '' || $activation_code !== '') {
            $selectActiveCode = $mysqli->query("SELECT * FROM activation_code WHERE user_mail = '$email' AND code = '$activation_code' AND type = 'forgot'");
            if ($selectActiveCode) {
                $sqlNums = $selectActiveCode->num_rows;
                if ($sqlNums < 1) {
                    $_code = 400;
                    $json = $functions->handleError('code_not_found');
                } else {
                    $options = [
                        'cost' => 11
                    ];
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);
                    $updateUserQuery = $mysqli->query("UPDATE users SET password = '$passwordHash' WHERE email = '$email'");
                    if ($updateUserQuery) {
                        $delete = $mysqli->query("DELETE FROM activation_code WHERE user_mail='$email'");
                        $_code = 200;
                        $json['data'] = 'password_change_success';
                    } else {
                        $_code = 400;
                        $json = $functions->handleError($mysqli->error);
                    }
                }
            } else {
                $_code = 400;
                $json = $functions->handleError($mysqli->error);
            }
        } else {
            $_code = 400;
            $json = $functions->handleError('please_do_not_leave_blank_lines');
        }
    }
}

$functions->setHeader($_code);
echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($mysqli);
