<?php
require "core/function.php";
$functions = new FunctionClass();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    $_code = 200;
    $json['data'] = 'OPTIONS';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $getType = $_GET['type'];
        if ($getType === 'set-hint') {
            $setHint = $mysqli->query("UPDATE MY_BLOG SET Hint = Hint + 1 WHERE BlogID = '$getType'");
            if ($setHint) {
                $_code = 201;
                $json['message'] = 'success';
            } else {
                $_code = 400;
                $json = $functions->handleError($mysqli->error);
            }
        } else {
            $selectBlogQuery = $mysqli->query("SELECT MY_BLOG.*,(SELECT group_concat(CONCAT('{\"CommentDate\": \"',COALESCE(BLOG_COMMENT.CommentDate, ''), '\", \"Name\" : \"', COALESCE(BLOG_COMMENT.Name, ''), '\", \"Comment\" : \"', COALESCE(BLOG_COMMENT.Comment, ''),'\", \"Email\" : \"', COALESCE(BLOG_COMMENT.Email, ''),'\", \"WebSite\" : \"', COALESCE(BLOG_COMMENT.WebSite, ''),'\"}')) FROM BLOG_COMMENT WHERE BLOG_COMMENT.BlogID = MY_BLOG.BlogID AND BLOG_COMMENT.Status = 1) AS COMMENTS FROM MY_BLOG WHERE Active = 1 AND BlogID = '$getType' ORDER BY Date DESC");
            if ($selectBlogQuery) {
                $_code = 201;
                $json = $selectBlogQuery->fetch_array(MYSQLI_ASSOC);

                $json['COMMENTS'] = json_decode('[' . $json['COMMENTS'] . ']');
            } else {
                $_code = 400;
                $json = $functions->handleError($mysqli->error);
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $getType = $_GET['type'];
        if ($getType === 'add-comment') {
            $postObject = json_decode(file_get_contents("php://input"));
            $BlogID = $postObject->BlogID;
            $Name = $functions->firewall($mysqli, $postObject->Name);
            $Comment = $functions->firewall($mysqli, $postObject->Comment);
            $Email = $functions->firewall($mysqli, $postObject->Email);
            $WebSite = $functions->firewall($mysqli, $postObject->WebSite);
            $insertQueryString = "INSERT INTO BLOG_COMMENT(Status, BlogID, Name, Email, Comment, WebSite, CommentDate) values (0,'$BlogID','$Name','$Email','$Comment','$WebSite',now())";
            $insertQuery = $mysqli->query($insertQueryString);
            if ($insertQuery) {
                $_code = 201;
                $json['message'] = 'success';
            } else {
                $_code = 400;
                $json = $functions->handleError($mysqli->error);
            }
        } else {
            $_code = 400;
            $json = $functions->handleError('error_input');
        }
    } else {
        $_code = 405;
        $json = $functions->handleError('not_accepted_method');
    }
}
$functions->setHeader($_code);
echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($mysqli);
ob_end_flush();
