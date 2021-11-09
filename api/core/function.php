<?php

require "database.php";

header("Content-Type: application/json");

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Security-Policy: upgrade-insecure-requestsdefault-src 'none';");
    header('Access-Control-Allow-Methods: OPTIONS,HEAD,GET,POST,DELETE,PUT');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: HEAD,GET,POST,DELETE,PUT");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
}

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';

// Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

class  FunctionClass
{

    function setRoute()
    {
        $this->dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/user', function ($response) {
            });
            // {id} must be a number (\d+)
            $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
            // The /{title} suffix is optional
            $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
            $this->httpMethod = $_SERVER['REQUEST_METHOD'];
            $this->uri = $_SERVER['REQUEST_URI'];
        });
    }

    protected $status;
    public $dispatcher;
    public $httpMethod;
    public $uri;

    function httpStatus($code)
    {
        $this->status = array(
            100 => 'Devam et',
            101 => 'Anahtarlama Protokolü',
            200 => 'Bitti',
            201 => 'Oluşturuldu',
            202 => 'Onaylandı',
            203 => 'Yetersiz Bilgi',
            204 => 'İçerik Yok',
            205 => 'İçeriği Baştan Al',
            206 => 'Kısmi İçerik',
            300 => 'Çok Seçenek',
            301 => 'Kalıcı Olarak Taşındı',
            302 => 'Found',
            303 => 'Diğelerlerine Bak',
            304 => 'Güncellenmedi',
            305 => 'Proxy Kullan',
            306 => '(Unused)',
            307 => 'Geçici olarak yeniden gönder',
            400 => 'Kötü İstek',
            401 => 'Yetkiniz Bulunmuyor',
            402 => 'Ödeme Gerekli',
            403 => 'Yasaklandı',
            404 => 'Bulunmadı',
            405 => 'İzin verilmeyen Metod',
            406 => 'Kabul Edilemez',
            407 => 'Proxy Authentication Required',
            408 => 'İstek zaman aşamına uğradı',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Sunucuda bir hata oluştu ve istek karşılanamadı.',
            501 => 'Sunucu istenilen isteği yerine getirecek şekilde yapılandırılmamıştır',
            502 => 'Geçersiz Ağ Geçidi',
            503 => 'Sunucu şu anda hizmet vermiyor (kapalı veya erişilemiyor).',
            504 => 'Gateway veya Proxy sunucusu, kaynağın bulunduğu sunucudan (upstream sunucusu) belirli bir zaman içinde cevap alamadı.',
            505 => 'HTTP Protokol versiyonu desteklenmiyor.');
        return $this->status[$code] ? $this->status[$code] : $this->status[501];
    }

    function setHeader($code)
    {
        header("HTTP/1.1 " . $code . " " . $this->httpStatus($code));
    }

    function permalink($value)
    {
        $turkish = array("ü", "Ü", "ö", "Ö", "(", ")", "ğ", "Ğ", "ı", "I", "ə", "Ə", "ç", "Ç", "ş", "Ş", " ", "/", "*", "?");
        $correct = array("u", "U", "o", "O", "", "", "g", "G", "i", "İ", "a", "A", "c", "C", "s", "S", "-", "-", "-", "");
        $value = str_replace($turkish, $correct, $value);
        $value = preg_replace("@[^A-Za-z0-9-_]+@i", "", $value);
        return $value;
    }

    function randomNumber($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
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

    function getAllHeaders()
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    function handleError($error)
    {
        $json = [];
        $json['outcome_type'] = 'error';
        $json['uimessage'][0]['text'] = trim($error);
        $json['iomessage'] = [];
        return $json;
    }

    function handleSuccess($data, $offset, $limit)
    {
        $json = [];
        $json['outcome_type'] = 'success';
        $json['status'] = 0;
        $json['query']['paging']['offset'] = $offset;
        $json['query']['paging']['limit'] = $limit;
        $json['query']['paging']['fetch'] = 'LAZY';
        $json['query']['paging']['total'] = $data[0] ? $data[0]['total'] : 0;
        $json['data'] = $data;
        $json['uimessage'] = [];
        $json['iomessage'] = [];
        return $json;
    }

    function makeForgotPasswordMail($fullName, $mailAddress, $userName, $activationCode, $type, $language)
    {
        include __DIR__ . '/../lang/az.php';
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }

    body,
    table,
    td,
    p,
    a,
    li,
    blockquote {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      -ms-interpolation-mode: bicubic;
    }

    body {
      margin: 0;
      padding: 0;
    }

    img {
      border: 0 none;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    a img {
      border: 0 none;
    }

    .imageFix {
      display: block;
    }

    table,
    td {
      border-collapse: collapse;
    }

    #bodyTable {
      height: 100% !important;
      margin: 0;
      padding: 0;
      width: 100% !important;
    }

    #footer a {
      color: #00a4bd;
      text-decoration: none;
    }

    /* Responsive Styles */

    @media only screen and (max-width: 480px) {
      .responsiveRow {
        width: 100% !important;
      }

      .responsiveColumn {
        display: block !important;
        width: 100% !important;
      }
    }
  </style>
  <title>' . $lang['_FORGOT_PASSWORD_TITLE'] . '</title>
</head>

<body leftmargin="0"
      marginwidth="0"
      topmargin="0"
      marginheight="0"
      offset="0"
      bgcolor="#f5f8fa"
      style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; margin: 0; padding: 0; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; height: 100%; width: 100%; min-width: 100%;">
  <table id="outerWrapper"
       border="0"
       cellpadding="0"
       cellspacing="0"
       height="100%"
       width="100%"
       bgcolor="#f5f8fa"
       style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; color: #425b76; line-height: 1.5; width: 100%; min-width: 100%; background-color:#f5f8fa;">
  <tbody>
  <tr>
    <td align="center" valign="top">
      <table border="0"
             cellpadding="20"
             cellspacing="0"
             width="600"
             style="width: 600px;"
             class="emailContainer">
        <tbody>
        <tr>
          <td align="center"
              valign="top"
              width="100%"
              style="width: 100%; min-width: 100%;">
            <table cellpadding="12"
                   border="0"
                   cellspacing="0"
                   width="100%"
                   bgcolor="#ff7a59"
                   style="width: 100%; min-width:100%;">
              <tbody>
              <tr>
                <td align="center"
                    valign="middle"
                    width="100%"
                    style="background: white; width: 100%; padding: 20px; min-width:100%; color: #ffffff">
                  <img src="https://api.cargodiem.az/assets/images/logo.png"
                       alt="Tufine Logo" width="120" height="48"
                       style="height: 110px; vertical-align: middle; clear: both; width: auto; max-width: 100%;">
                  <span style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; color: transparent; background: none; user-select: none; -moz-user-select: none; -ms-user-select:none; -webkit-user-select:none; text-overflow: ellipsis; opacity: 0; width:100%; min-width: 100%; height:1px; overlfow:hidden; margin: -1px 0 0 0; padding:0; font-size: 0;">&nbsp;</span>
                </td>
              </tr>
              </tbody>
            </table>
            <table id="backgroundTable"
                   border="0"
                   cellpadding="0"
                   cellspacing="0"
                   height="100%"
                   width="100%"
                   bgcolor="#ffffff"
                   style="width: 100%; min-width: 100%;">
              <tbody>
              <tr>
                <td align="left"
                    valign="top"
                    style="font-size: 16px; padding: 0 50px">
                  <table cellpadding="0"
                         border="0"
                         cellspacing="0"
                         width="100%"
                         style="color: #425b76; background-color: #fff; font-size: 20px; width: 100%; margin: initial; min-width: 100%; ">
                    <tbody>
                    <tr>
                      <td align="center"
                          valign="middle"
                          style="padding: 0; ">
                        <img src="https://api.cargodiem.az/assets/images/mail-icon.png"
                             alt="email-forwarding"
                             style="max-width: 150px; margin-top: 15px; height: 120px !important;">
                        <table border="0"
                               cellpadding="0"
                               cellspacing="0"
                               width="100%"
                               style="font-size: 0; height: 20px; width: 100%; min-width: 100%; line-height: 0;">
                          <tbody>
                          <tr>
                            <td height="20">
                              <span
                                style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; color: transparent; background: none; user-select: none; -moz-user-select: none; -ms-user-select:none; -webkit-user-select:none; text-overflow: ellipsis; opacity: 0; width:100%; min-width: 100%; height: 1px; overlfow:hidden; margin: -1px 0 0 0; padding:0; font-size: 0;"> &nbsp;</span>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                        <h1 style="font-size: 16px; font-weight: 600; margin: 0; text-align: left; color: #2c3b47;">' . $lang['_FORGOT_PASSWORD_TITLE'] . '</h1>
                        <p style="font-size: 14px; margin: 10px 0 0 0; text-align: left; color: #8f99a4">' . $fullName . $lang['_ADD_NEW_ACCOUNT_WITH_THIS_EMAIL'] . '</p>
                       <p style="font-size: 14px; margin: 10px 0 0 0; text-align: left; color: #8f99a4"> ' . $lang['_FORGOT_CODE_DESCRIPTION'] . '</p>
                        <input type="text"
                               disabled
                               value="' . $activationCode . '"
                               id="confirmCode"
                               style="font-size: 28px; font-weight: 600; cursor: pointer; margin: 10px 0 0 0; padding: 6px 0; border: 1px dashed #425b76; text-align: center; letter-spacing: 5px;">
                        <table border="0"
                               cellpadding="0"
                               cellspacing="0"
                               width="100%"
                               style="font-size: 0; height: 30px; width: 100%; min-width: 100%; line-height: 0;">
                          <tbody>
                          <tr>
                            <td height="30">
                              <span
                                style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; color: transparent; background: none; user-select: none; -moz-user-select: none; -ms-user-select:none; -webkit-user-select:none; text-overflow: ellipsis; opacity: 0; width:100%; min-width: 100%; height: 1px; overlfow:hidden; margin: -1px 0 0 0; padding:0; font-size: 0;"> &nbsp;</span>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                        <table border="0"
                               cellpadding="0"
                               cellspacing="0"
                               width="100%"
                               style="font-size: 0; height: 30px; width: 100%; min-width: 100%; line-height: 0;">
                          <tbody>
                          <tr>
                            <td height="30">
                              <span
                                style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; color: transparent; background: none; user-select: none; -moz-user-select: none; -ms-user-select:none; -webkit-user-select:none; text-overflow: ellipsis; opacity: 0; width:100%; min-width: 100%; height: 1px; overlfow:hidden; margin: -1px 0 0 0; padding:0; font-size: 0;"> &nbsp;</span>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                        <p style="font-size: 14px; font-weight: 100; margin: 0; text-align: left; color: #8f99a4">' . $lang['_DON_ATTENTION_THIS_MAIL_DESCRIPTION'] . '</p>
                        <hr style="height: 1px; color: #eaf0f6; background-color: #eaf0f6; border: none; margin: 0px; padding: 0px;">
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              </tbody>
            </table>
            <table id="footer"
                   border="0"
                   cellpadding="0"
                   cellspacing="0"
                   height="100%"
                   width="100%"
                   bgcolor="#f5f8fa" style="width: 100%; min-width: 100%;">
              <tbody>
              <tr>
                <td align="center" valign="top">
                  <table cellpadding="0"
                         border="0"
                         cellspacing="0"
                         width="100%"
                         style="color: #425b76; background-color: #fff; font-size: 14px; width: 100%; margin: initial; min-width: 100%; line-height: 24px">
                    <tbody>
                    <tr>
                      <td align="center" valign="middle" style="padding: 20px 0 65px; ">
                        ' . $lang['_ADDRESS_DESCRIPTION'] . '
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              </tbody>
            </table>
          </td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>
';

        return $this->sendMail("CargoDiem", $lang['_FORGOT_PASSWORD_TITLE'], $html, $mailAddress, $userName);
    }

    function sendMail($sender, $subject, $body, $mailAddress, $name)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'mail.cargodiem.az';
            $mail->SMTPAuth = true;
            $mail->Username = 'customer@cargodiem.az';
            $mail->Password = 'crgDieM1453';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('customer@cargodiem.az', $sender);
            $mail->addAddress($mailAddress, $name);
            //$mail->addAttachment('https://cdn.domainhizmetleri.com/tmp/image.jpg', 'new.jpg');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return 'mail_send';
        } catch (Exception $e) {
            return "Ops! Error: {$mail->ErrorInfo}";
        }
    }

    public function upload($type, $base64string = '', $file_name = '', $fileExt = '', $folder = '')
    {
        ini_set('memory_limit', '128M');
        if ($type === 'file') {
            return $this->uploadFile($base64string, $file_name, $folder, $fileExt);
        } elseif ($type === 'image') {
            return $this->uploadImage($base64string, $file_name, $folder, $fileExt);
        }
    }

    public function uploadImage($base64string = '', $file_name = '', $folder = '', $fileExt = '')
    {
        if (!empty($base64string)) {
            $base64string = str_replace('data:image/' . $fileExt . ';base64,', '', $base64string);
            $base64string = str_replace(' ', '+', $base64string);
            $base64Data = base64_decode($base64string);
            $file_path = "{$folder}/{$file_name}";
            $result = file_put_contents($file_path, $base64Data);
        }

        return $result;
    }

    public function uploadFile($base64string = '', $file_name = '', $folder = '', $fileExt = 'pdf')
    {
        if (!empty($base64string)) {
            $base64string = str_replace('data:application/' . $fileExt . ';base64,', '', $base64string);
            $base64string = str_replace(' ', '+', $base64string);
            $base64Data = base64_decode($base64string);
            $file_path = "{$folder}/{$file_name}";
            $result = file_put_contents($file_path, $base64Data);
        }

        return $result;
    }

    function sendSms($receiver, $content)
    {
//        $content = $content . '/n www.cargodiem.az';
        $input_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
            <SMS-InsRequest>
             <CLIENT  user="cargodiemapi" pwd="fMaMFxV9" from="CARGODIEM"/>
             <INSERT to="' . $receiver . '" text="' . $content . '" />
             </SMS-InsRequest>';


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.msm.az/sendsms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $input_xml,
            CURLOPT_HTTPHEADER => array("Content-Type: application/xml")
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    function sendPanelNotification($fields, $type)
    {
        $url = 'https://cargodiem.herokuapp.com/panel/' . $type . '/message';
        $fields['priority'] = "high";
        $data = json_encode($fields);
        return $this->apiPost($url, $data, array('Content-Type: application/json'));
    }

    function sendNotification($fields)
    {
        $fields['priority'] = "high";
        $fields['restricted_package_name'] = "";
        $fields['notification']['sound'] = "www/assets/sound/notification.mp3";
        $fields['notification']['click_action'] = "FCM_PLUGIN_ACTIVITY";
        $fields['notification']['icon'] = "fcm_push_icon";
        $fields['notification']['content_available'] = true;
        $data = json_encode($fields);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = 'AAAAFN8CZ_Y:APA91bG3qaIQqGzgOvlH0BsiO0rc_MfNjOdameQ7YviH9mF8lezOLN0EaGq9zSKztMArOe0kUzKYeqCCqxhekuG5KNE0UR50DSpufd0piY8hhXP2yp50uAAUH9NhEarn-tnzI_7SOXKd';
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );
        return $this->apiPost($url, $data, $headers);
    }

    function sendRealTimeMessage($fields)
    {
        $data = json_encode($fields);
        $url = 'https://cargodiem.herokuapp.com/panel/user/message';
        $headers = array('Content-Type:application/json');
        return $this->apiPost($url, $data, $headers);
    }

    function apiPost($url, $data, $headers = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        return curl_exec($ch);
    }

    function validateEmail($mail)
    {
        $reg = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
        return preg_match($reg, $mail);
    }

    function firewall($mysqli, $incoming) {
        return $mysqli->real_escape_string(strip_tags(trim($this->stringReplace($incoming))));
    }

    function stringReplace($string){
        $character = array("Ã§", "Ã‡", "ÄŸ", "Ä", "Ğ±", "Ğ°", "Ã¶", "Ã–", "ÅŸ", "Å", "Ã¼", "Ãœ");
        $character_change = array("ç", "Ç", "ğ", "Ğ", "ı", "İ", "ö", "Ö", "ş", "Ş", "ü", "Ü");
        $string = str_replace($character, $character_change, $string);
        return $string;
    }
}
