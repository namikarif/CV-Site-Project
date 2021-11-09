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
        if ($postObject->firstname !== ''
            && $postObject->lastname !== ''
            && $postObject->email !== ''
            && $postObject->password !== ''
            && $postObject->telephone !== ''
            && $postObject->adress !== '') {
            if ($functions->validateEmail($postObject->email)) {
                $selectMail = $mysqli->query("SELECT * FROM users WHERE email ='" . $postObject->email . "'");
                if ($selectMail) {
                    $count = $selectMail->num_rows;
                    if ($count > 0) {
                        $_code = 400;
                        $json = $functions->handleError('have_this_mail_error');
                    } else {
                        if ($postObject->citizenship === 'AZE') {
                            $selectDocId = $mysqli->query("SELECT * FROM users WHERE doc_id = '$postObject->doc_id'");
                            $errorMessage = 'have_this_doc_id_error';
                        } else {
                            $selectDocId = $mysqli->query("SELECT * FROM users WHERE migration_number = '$postObject->migration_number'");
                            $errorMessage = 'have_this_migration_number_error';
                        }
                        if ($selectDocId) {
                            $countDocId = $selectDocId->num_rows;
                            if ($countDocId > 0) {
                                $_code = 400;
                                $json = $functions->handleError($errorMessage);
                            } else {
                                $self_link = uniqid();
                                $options = [
                                    'cost' => 11
                                ];
                                $passwordHash = password_hash($postObject->password, PASSWORD_BCRYPT, $options);
                                $userQuery = $mysqli->query('SELECT customer_number FROM users ORDER BY id DESC LIMIT 1');
                                if ($userQuery) {
                                    $userDetail = $userQuery->fetch_array(MYSQLI_ASSOC);
                                    $customerNumber = 100000;
                                    if ($userDetail['customer_number']) {
                                        $customerNumber = $userDetail['customer_number'] + 1;
                                    }
                                    $language = $postObject->language ? $postObject->language : 'az';
                                    $sqlString = "INSERT INTO users (firstname, lastname, email, password, telephone, citizenship, migration_number, doc_id, fin, gender, address, customer_number, birthday, sef_link, language) VALUES('" . $postObject->firstname . "', '" . $postObject->lastname . "', '" . $postObject->email . "', '" . $passwordHash . "', '" . $postObject->telephone . "', '" . $postObject->citizenship . "', '" . $postObject->migration_number . "', '" . $postObject->doc_id . "', '" . $postObject->fin . "', '" . $postObject->gender . "', '" . $postObject->address . "', '" . $customerNumber . "', '" . $postObject->birthday . "', '" . $self_link . "', '" . $language . "')";
                                    $insertQuery = $mysqli->query($sqlString);
                                    if ($insertQuery) {
                                        $_code = 201;
                                        $json['message'] = 'process_success';
                                        $functions->sendSms($postObject->telephone, $text = 'Hörmətli müştəri qeydiyyatınız uğurla tamamlanmışdır. Müştəri kodunuz: '. $customerNumber);
                                    } else {
                                        $_code = 400;
                                        $json = $functions->handleError($mysqli->error);
                                    }
                                } else {
                                    $_code = 400;
                                    $json = $functions->handleError('some_problem_happen');
                                }
                            }
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
