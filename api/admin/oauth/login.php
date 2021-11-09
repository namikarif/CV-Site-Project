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
        $current_lang = $postObject->language ? $postObject->language : 'az';
        if ($email != '' || $password != '') {
            if (strlen($password) < 6) {
                $_code = 400;
                $json = $functions->handleError('password_length_error');
            } else {
                $sql = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
                $sqlNums = $sql->num_rows;
                if ($sqlNums < 1) {
                    $_code = 401;
                    $json = $functions->handleError('email_not_found');
                } else {
                    $rows = $sql->fetch_array(MYSQLI_ASSOC);
                    if ($rows['is_deleted'] === 0) {
                        $compare = password_verify($password, $rows['password']);
                        if ($compare) {
                            $createToken['error'] = true;
                            $userId = $rows['id'];
                            $createToken = createToken($userId, 'user');
                            if ($createToken != null) {
                                $_code = 200;
                                $access_tokenData = $createToken['access_token'] . ':' . $userId . ':user';
                                $refresh_tokenData = $createToken['refresh_token'] . ':' . $userId . ':user';
                                $accessEncryption = $crypto->encryption($access_tokenData);
                                $refreshEncryption = $crypto->encryption($refresh_tokenData);
                                $json['user'] = $rows;
                                $json['refresh_token'] = $refreshEncryption;
                                $json['access_token'] = $accessEncryption;
                                unset($json['user']['password']);
                                $log_date = date("Y-m-d H:i:s");
                                $update = $mysqli->query("UPDATE users SET language = '$current_lang', online_date = '$log_date', online = '1' WHERE id = '$userId'");
                            } else {
                                $_code = 404;
                                $json = $functions->handleError('unknown_error');
                            }
                        } else {
                            $_code = 401;
                            $json = $functions->handleError('email_or_password_wrong_message');
                        }
                    } else {
                        $_code = 401;
                        $json = $functions->handleError('account_had_been_deleted');
                    }
                }
            }
        } else {
            $_code = 404;
            $json = $functions->handleError('please_do_not_leave_blank_lines');
        }
    }
}

$functions->setHeader($_code);
echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($mysqli);
