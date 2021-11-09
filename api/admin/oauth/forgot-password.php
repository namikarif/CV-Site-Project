<?php
require "./core/control.php";
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
        if ($email != '') {
            if ($functions->validateEmail($email)) {
                $sql = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
                $sqlNums = $sql->num_rows;
                if ($sqlNums < 1) {
                    $_code = 401;
                    $json = $functions->handleError('email_not_found');
                } else {
                    $rows = $sql->fetch_array(MYSQLI_ASSOC);
                    if ($rows['is_deleted'] === 0) {
                        $selectActivationCode = $mysqli->query("SELECT * FROM activation_code WHERE user_mail = '$email' AND type = 'forgot'");
                        if ($selectActivationCode) {
                            $numRows = $selectActivationCode->num_rows;
                            $activationCode = $functions->randomNumber(6);
                            if ($numRows > 0) {
                                $insertCode = $mysqli->query("UPDATE activation_code SET code = '$activationCode' WHERE user_mail = '$email' AND type = 'forgot'");
                            } else {
                                $insertCode = $mysqli->query("INSERT INTO activation_code(code,user_mail,type) VALUES ('$activationCode','$email','forgot')");
                            }
                            if ($insertCode) {
                                $successSendMail = $functions->makeForgotPasswordMail($userDetail['surname'] . ' ' . $userDetail['name'], $email, $userDetail['name'], $activationCode, 'forgot_password', $current_lang);
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
                        } else {
                            $_code = 400;
                            $json = $functions->handleError('some_error_happen');
                        }
                    } else {
                        $_code = 401;
                        $json = $functions->handleError('account_had_been_deleted');
                    }
                }
            } else {
                $_code = 400;
                $json = $functions->handleError('invalid_email_format');
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
