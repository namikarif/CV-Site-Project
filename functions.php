<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require 'database.php';
define('active_page', $_SERVER['REQUEST_URI']);
define('ip', $_SERVER['REMOTE_ADDR']);
define('browser', $_SERVER['HTTP_USER_AGENT']);
define('previous_page', @$_SERVER['HTTP_REFERER']);

$ip = ip;

$selectBlockedIpQueryString = $mysqli->query("SELECT * FROM BLOCKED_IP WHERE IP = '$ip'");

if ($selectBlockedIpQueryString) {
    if ($selectBlockedIpQueryString->num_rows > 0) {
    include 'blockedip.php';
    exit();
    }
} else {

    function saveReferer()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = firewall($_SERVER['HTTP_REFERER']);
        } else {
            $referer = '';
        }
        $ip = ip;
        $countryCode = trim(file_get_contents("https://ipinfo.io/{$ip}/country"));
        $requestUrl = $_SERVER['REQUEST_URI'];
        $date = date("Y-m-d H:i:s");
        mysqliQuery("INSERT INTO SITE_LOGS(RefererURL, UserIP, CountryCode, RequestURL, Date) VALUES ('$referer','$ip','$countryCode','$requestUrl','$date')");

    }

    function mysqliQuery($query)
    {
        global $mysqli;
        $this_query = $mysqli->query($query);
        if (!$this_query) {
            $error = str_replace("'", "", $mysqli->errno);
            $error_no = $mysqli->errno;
            $mysqli->query("INSERT INTO SQL_QUERY_ERROR values ('$query','" . ((active_page <> '/') ? active_page : previous_page) . "','$error','$error_no','" . ip . "',now())");
        } else {
            return $this_query;
        }
    }

    function mysqli_result($result, $row, $field = 0)
    {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return $results_array[$field];
    }

    function console($data) {
        echo "<script>console.log('" . $data . "' );</script>";
    }

    function query($select, $table, $where = NULL, $orderby = NULL)
    {
        $selectQueryString = "SELECT $select FROM $table " . (($where) ? 'WHERE ' . $where : '') . " " . (($orderby <> '') ? "ORDER BY $orderby " : '') . " LIMIT 1";
        $selectQuery = mysqliQuery($selectQueryString);
        if ($selectQuery->num_rows == 1) {
            $return = mysqli_result($selectQuery, 0, 0);
            $explode = explode(",", $select);
            $count = count($explode);
            if ($count == 1) {
                return $return;
            } else {
                for ($i = 1; $i < $count; $i++) {
                    $return = $return . ' ' . mysqli_result($selectQuery, 0, $i);
                }
                return $return;
            }

        } else {
            return '';
        }
    }

    function stringReplace($string)
    {
        $character = array("Ã§", "Ã‡", "ÄŸ", "Ä", "Ğ±", "Ğ°", "Ã¶", "Ã–", "ÅŸ", "Å", "Ã¼", "Ãœ");
        $character_change = array("ç", "Ç", "ğ", "Ğ", "ı", "İ", "ö", "Ö", "ş", "Ş", "ü", "Ü");
        $string = str_replace($character, $character_change, $string);
        return $string;
    }

    function firewall($incoming)
    {
        global $mysqli;
        return $mysqli->real_escape_string(strip_tags(trim(stringReplace($incoming))));
    }

    function months()
    {
        echo '<option value="1">01 - January</option>';
        echo '<option value="2">02 - February</option>';
        echo '<option value="3">03 - March</option>';
        echo '<option value="4">04 - April</option>';
        echo '<option value="5">05 - May</option>';
        echo '<option value="6">06 - June</option>';
        echo '<option value="7">07 - July</option>';
        echo '<option value="8">08 - August</option>';
        echo '<option value="9">09 - September</option>';
        echo '<option value="10">10 - October</option>';
        echo '<option value="11">11 - November</option>';
        echo '<option value="12">12 - December</option>';
    }

    function changeMonthToString($month)
    {
        switch ($month) {
            case 1:
                return 'January';
            case 2:
                return 'February';
            case 3:
                return 'March';
            case 4:
                return 'April';
            case 5:
                return 'May';
            case 6:
                return 'June';
            case 7:
                return 'July';
            case 8:
                return 'August';
            case 9:
                return 'September';
            case 10:
                return 'October';
            case 11:
                return 'November';
            case 12:
                return 'December';
        }
    }

    function years()
    {
        for ($year = date('Y'); $year > 1949; $year--) {
            echo '<option value="' . $year . '">' . $year . '</option>';
        }
    }

    function percent()
    {
        for ($p = 100; $p > 9; $p--) {
            echo '<option value="' . $p . '">' . $p . '</option>';
        }
    }

    function ActiveDate($date)
    {
        $year = substr($date, 0, 4);
        $time = substr($date, 11, 5);
        $day = substr($date, 8, 2);
        $month = getMonths(substr($date, 5, 2));
        $source = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $target = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $which_day = str_replace($source, $target, date("l", mktime(10, 00, 59, substr($date, 5, 2), $day, $year)));

        if ($year == date("Y")) {
            $finally_date = ($day . ' ' . $month . ', ' . $which_day . ' | ' . $time);
        } else {
            $finally_date = ($day . ' ' . $month . ' ' . $year . ', ' . $which_day . ' | ' . $time);
        }

        if (!is_numeric($date)) $date = strtotime($date);
        $date = $date + 30;

        $diff = time() - $date;
        $second = $diff;
        $minute = round($diff / 60);
        $hour = round($diff / 60 / 60);
        $day = round($diff / 60 / 60 / 24);
        $week = round($diff / 60 / 60 / 24 / 7);
        $month = round($diff / 60 / 60 / 24 / 7 / 4);
        $year = round($diff / 60 / 60 / 24 / 7 / 4 / 12);

        if ($second < 10) {
            return '<span title="' . $finally_date . '" >Just Now</span>';
        } elseif ($second < 60) {
            return '<span title="' . $finally_date . '" >' . $second . ' seconds ago</span>';
        } elseif ($minute < 60) {
            return '<span title="' . $finally_date . '" >' . $minute . ' minute ago</span>';
        } elseif ($hour < 24) {
            if ($hour < 4) {
                return '<span title="' . $finally_date . '" >' . $hour . ' hour ago</span>';
            } else {
                return '<span title="' . $finally_date . '" >(' . $time . ')</span>';
            }
        } elseif ($day < 7) {
            if ($day == 1) {
                return '<span title="' . $finally_date . '" >Yesterday (' . $time . ')</span>';
            } else {
                return '<span title="' . $finally_date . '" >' . $which_day . ' (' . $time . ')</span>';
            }
        } elseif ($week < 4) {
            if ($week == 1) {
                return '<span title="' . $finally_date . '" >Last week ' . $which_day . ' (' . $time . ')</span>';
            } else {
                return '<span title="' . $finally_date . '" >' . $week . ' Week ago</span>';
            }
        } elseif ($month == 1) {
            return '<span title="' . $finally_date . '" >Last month</span>';
        } elseif ($month < 12) {
            return '<span title="' . $finally_date . '" >' . $month . ' Month ago</span>';
        } elseif ($year == 1) {
            return '<span title="' . $finally_date . '" >Last year</span>';
        } else {
            return '<span title="' . $finally_date . '" >' . $year . ' year ago</span>';
        }
    }

    function getMonths($month)
    {
        $months = array(
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        );
        return $months[$month];
    }

    function projectCategories()
    {
        $categories = mysqliQuery("SELECT CategoryID, CategoryName from PROJECT_CATEGORIES order by CategoryName asc");
        while ($row = $categories->fetch_array(MYSQLI_ASSOC)) {
            echo '<option id="category_' . $row['CategoryID'] . '" value="' . $row['CategoryID'] . '">' . $row['CategoryName'] . '</option>';
        }
    }

    $action = '';
    if (isset($_REQUEST['action']))
        $action = $_REQUEST['action'];

    if ($action) {
        switch ($action) {
            case 'login':
                $userName = firewall($_POST['userName']);
                $password = firewall($_POST['password']);
                if ($userName && $password) {
                    $query = $mysqli->query("SELECT * FROM SITE_SETTINGS WHERE UserName='$userName' and UserPassword='$password'");
                    if ($query) {
                        if ($query->num_rows > 0) {
                        $_SESSION['login'] = 'on';
                        $_SESSION['userName'] = $userName;
                         echo '1';
                        } else {
                        echo '3';
                    }
                    } else {
                        echo '3';
                    }
                } else {
                    echo '2';
                }
                break;
            case 'exit':
                session_destroy();
                echo 'clear_session';
                break;
        }
    }

    $setting = '';
    if (isset($_REQUEST['setting']))
        $setting = $_REQUEST['setting'];

    if ($setting) {
        $theme = firewall($_POST['theme']);
        $explode = explode('#', firewall($_POST['css']));
        $css = $explode[0];
        $hex = $explode[1];

        $json['css'] = $css;
        $json['oldCss'] = $_SESSION['Css'];

        $json['hex'] = $hex;
        $json['oldHex'] = $_SESSION['Hex'];

        $json['theme'] = $theme;
        $json['oldTheme'] = $_SESSION['Theme'];

        $_SESSION['Hex'] = $hex;
        $_SESSION['Theme'] = $theme;
        $_SESSION['Css'] = $css;
        echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    $commentProcess = '';
    if (isset($_REQUEST['commentProcess']))
        $commentProcess = $_REQUEST['commentProcess'];

    if ($commentProcess) {
        $postID = firewall($_POST['postID']);
        $comment = addslashes($_POST['comment']);
        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $website = addslashes($_POST['website']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($comment && $name && $email) {
                $insertQueryString = "INSERT INTO BLOG_COMMENT(Status, BlogID, Name, Email, Comment, WebSite, CommentDate) values (0,'$postID','$name','$email','$comment','$website',now())";
                $insert = mysqliQuery($insertQueryString);
                if ($insert) {
                    $lastID = $mysqli->insert_id;
                    echo 'success';
                } else {
                    echo '3';
                }
            } else {
                echo '1';
            }
        } else {
            echo '2';
        }
    }

    $process = '';
    if (isset($_REQUEST['process']))
        $process = $_REQUEST['process'];

    if ($process) {
        if ($_SESSION['login'] <> 'on' && $process <> 'login' && $process <> 'get_blog') {
            echo 'bos';
            exit;
        } else {
        if ($_SESSION['userName'] == 'demo') {
            echo 'demo';
            exit;
        }
        }
        global $mysqli;
        switch ($process) {
            case 'moveToTop':
                $blogID = firewall($_POST['blogID']);
                mysqliQuery("UPDATE MY_BLOG set Date=now() where BlogID='$blogID'");
                break;
            case 'blockIP':
                $IP = firewall($_POST['IP']);
                if (ip !== $IP) {
                    $selectBlockedIp = query('count(1)', 'BLOCKED_IP', 'IP = ' . "'$IP'");
                    if ($selectBlockedIp['count(1)'] > 0) {
                        echo '2';
                    } else {
                        $insertQuery = mysqliQuery("INSERT INTO BLOCKED_IP (IP, Date) VALUES ('$IP', now());");
                        if ($insertQuery) {
                            echo 'success';
                        } else {
                            echo '1';
                        }
                    }
                } else {
                    echo '3';
                }
                break;
            case 'unBlockIP':
                $ID = firewall($_POST['ID']);
                $deleteQuery = mysqliQuery("DELETE FROM BLOCKED_IP WHERE ID = '$ID'");
                if ($deleteQuery) {
                    echo 'success';
                } else {
                    echo '2';
                }
                break;
            case 'saveSiteSettings':
                $title = firewall($_POST['title']);
                $keys = firewall($_POST['keys']);
                $description = firewall($_POST['description']);
                $theme = firewall($_POST['theme']);
                $explode = explode('#', firewall($_POST['tcss']));
                $css = $explode[0];
                $hex = $explode[1];
                $aboutMe = ((firewall($_POST['aboutMe']) == 1) ? 1 : 0);
                $experiences = ((firewall($_POST['experiences']) == 1) ? 1 : 0);
                $message = ((firewall($_POST['message']) == 1) ? 1 : 0);
                $blog = ((firewall($_POST['blog']) == 1) ? 1 : 0);
                $references = ((firewall($_POST['references']) == 1) ? 1 : 0);
                $skills = ((firewall($_POST['skill']) == 1) ? 1 : 0);
                $educations = ((firewall($_POST['educations']) == 1) ? 1 : 0);
                $projects = ((firewall($_POST['projects']) == 1) ? 1 : 0);
                $awards = ((firewall($_POST['awards']) == 1) ? 1 : 0);
                if ($title && $keys && $description) {
                    $count = query('count(1)', 'SITE_SETTINGS');
                    if ($count['count(1)'] == 1) {
                        $queryString = "UPDATE SITE_SETTINGS set `Theme`='$theme', `Hex`='$hex', `Css`='$css', `Awards`='$awards', `Blog`='$blog', `MyReferences`='$references', `AboutMe`='$aboutMe', `Experiences`='$experiences', `Educations`='$educations', `Projects`='$projects', `Message`='$message', `Skills`='$skills', `SiteTitle`='$title', `MetaKeys`='$keys', `Description`='$description'";
                        $update = mysqliQuery($queryString);
                        if ($update) {
                            echo '1';
                        } else {
                            echo 'error ' . $mysqli->error;
                        }
                    } else {
                        $insertQuerySting = "INSERT INTO SITE_SETTINGS(Theme, Hex, Css, Awards, Blog, MyReferences, AboutMe, Experiences, Educations, Projects, Message, Skills, SiteTitle, MetaKeys, Description) values ('$theme', '$hex', '$css', '$awards', '$blog', '$references', '$aboutMe', '$experiences', '$educations', '$projects', '$message', '$skills', '$title','$keys','$description')";
                        $query = mysqliQuery($insertQuerySting);
                        if ($query) {
                            echo '1';
                        } else {
                            echo $insertQuerySting;
                        }
                    }
                } else
                    echo '2';
                break;
            case 'saveGeneralSetting':
                $headerText = firewall($_POST['headerText']);
                $nameSurname = firewall($_POST['nameSurname']);
                $ShortText = firewall($_POST['ShortText']);
                $telephone = firewall($_POST['telephone']);
                $address = firewall($_POST['address']);
                $email = firewall($_POST['email']);
                $birthDay = firewall($_POST['birthDay']);
                $googleMap = firewall($_POST['googleMap']);
                $aboutMe = addslashes($_POST['aboutMe']);
                $facebook = firewall($_POST['facebook']);
                $skype = firewall($_POST['skype']);
                $skypeConnectionType = firewall($_POST['connectionType']);
                $twitter = firewall($_POST['twitter']);
                $linkedin = firewall($_POST['linkedin']);
                $tumblr = firewall($_POST['tumblr']);
                $instagram = firewall($_POST['instagram']);
                $youtube = firewall($_POST['youtube']);
                if ($headerText && $nameSurname && $aboutMe && $telephone && $email && $birthDay && $address && $ShortText) {
                    mysqliQuery("UPDATE GENERAL_INFORMATION set GoogleMap='$googleMap', SkypeConnectionType='$skypeConnectionType', HeaderText ='$headerText', NameSurname='$nameSurname', ShortText='$ShortText', BirthDate='$birthDay', Address='$address', Phone='$telephone', EMail='$email', AboutMe='$aboutMe', Facebook='$facebook', Twitter='$twitter', Instagram='$instagram', Tumblr='$tumblr', Youtube='$youtube', Linkedin='$linkedin', Skype='$skype'");
                    echo '1';
                } else
                    echo '2';
                break;
            case 'changeProfileImage':
                if (is_array($_FILES)) {
                    if (is_uploaded_file($_FILES['profileImage']['tmp_name'])) {
                        $sourcePath = $_FILES['profileImage']['tmp_name'];
                        $targetPath = "assets/images/profile.jpg";
                        $allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
                        $filename = $_FILES['profileImage']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowed)) {
                            echo '3';
                        } else {
                            if (move_uploaded_file($sourcePath, $targetPath))
                                echo '1';
                        }
                    } else
                        echo '2';
                } else
                    echo '2';
                break;
            case 'changeCoverImage':
                if (is_array($_FILES)) {
                    if (is_uploaded_file($_FILES['coverImage']['tmp_name'])) {
                        $sourcePath = $_FILES['coverImage']['tmp_name'];
                        $targetPath = "assets/images/cover.jpg";
                        $allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
                        $filename = $_FILES['coverImage']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowed)) {
                            echo '3';
                        } else {
                            if (move_uploaded_file($sourcePath, $targetPath))
                                echo '1';
                        }
                    } else
                        echo '2';
                } else
                    echo '2';
                break;
            case 'createBlogXml':
                $filePath = './blogpost.xml';
                if (file_exists($filePath)) {
                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                    $file = fopen($filePath, 'w');
                    fwrite($file, '<?xml version="1.0" encoding="UTF-8" ?>');
                    fwrite($file, "<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">
                                        <url>
                                            <loc>$actual_link</loc>
                                            <priority>1.00</priority>
                                        </url>");
                    $selectBlogQuery = mysqliQuery("SELECT * FROM MY_BLOG");
                    if ($selectBlogQuery) {
                        while ($row = $selectBlogQuery->fetch_array(MYSQLI_ASSOC)) {
                            $blogId = $row['BlogID'];
                            fwrite($file, "<url>
                                         <loc>$actual_link/blog/$blogId</loc>
                                         <changefreq>always</changefreq>
                                         <priority>1</priority>
                                       </url>");
                        }
                        echo '1';
                    } else {
                        echo '2';
                    }
                    fwrite($file, '</urlset>');
                    fclose($file);
                } else {
                    echo '3';
                }
                break;

            case 'addAward':
                $awardDescription = firewall($_POST['awardDescription']);
                $awardYear = firewall($_POST['awardYear']);
                if ($awardDescription && $awardYear) {
                    $insert = mysqliQuery("INSERT INTO AWARDS(AwardDescription,AwardYear) values ('$awardDescription','$awardYear')");
                    $lastID = $mysqli->insert_id;
                    echo '<tr id="awardTableItem' . $lastID . '"><td>' . $awardDescription . '</td><td>' . $awardYear . '</td><td><a onclick="deleteAward(\'' . $lastID . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td></tr>';
                } else {
                    echo '2';
                }
                break;
            case 'addBlog':
                $title = firewall($_POST['title']);
                $ShortText = addslashes($_POST['shortText']);
                $longText = addslashes($_POST['longText']);
                $metaKeys = addslashes($_POST['metaKeys']);
                $ShortText = str_replace('<p>', '', $ShortText);
                $ShortText = str_replace('</p>', '', $ShortText);
                $longText = str_replace('<p>', '', $longText);
                $longText = str_replace('</p>', '', $longText);
                $valid_extensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'); // valid extensions
                if ($title && $ShortText) {
                    if ($_FILES['blogImage']) {
                        $insertQueryString = "INSERT INTO MY_BLOG(BlogTitle, BlogShortDescription, BlogLongDescription, MetaKeys, Active, Date) values ('$title','$ShortText','$longText', '$metaKeys',1,now())";
                        $insert = mysqliQuery($insertQueryString);
                        $lastID = $mysqli->insert_id;
                        $targetPath = 'assets/images/blog/b' . $lastID . '.jpg';
                        $img = $_FILES['blogImage']['name'];
                        $tmp = $_FILES['blogImage']['tmp_name'];
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        if (in_array($ext, $valid_extensions)) {
                            if (move_uploaded_file($tmp, $targetPath)) {
                                echo '<tr id="blogTableItem' . $lastID . '">
                                    <td><a target="_blank" href="assets/images/blog/b' . $lastID . '.jpg"><img style="height: 110px; margin: auto;" src="assets/images/blog/b' . $lastID . '.jpg" alt="' . $title . '" class="img-responsive" /></td>
                                    <td><i class="fa fa-circle text-success" title="Publication"></i>' . $title . '</td>
                                    <td>' . strip_tags(stripslashes($ShortText)) . '</td>
                                    <td><span class="blog-content">' . strip_tags(stripslashes($longText)) . '</span></td>
                                    <td><a href="javascript:void(0);" onclick="moveToTop(' . $lastID . ')" class="btn btn-success btn-block"><i class="fa fa-arrow-up"></i> Move to Top</a> <a href="admin/editblog/' . $lastID . '" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Edit</a> <a onclick="deleteBlog(\'' . $lastID . '\');" class="btn btn-danger btn-block"><i class="fa fa-times"></i> Delete</a></td>
                                  </tr>';
                            } else {
                                mysqliQuery("delete from MY_BLOG where BlogID='$lastID'");
                                echo 'error';
                            }
                        } else {
                            echo '3';
                        }
                    } else {
                        echo '2';
                    }
                } else {
                    echo '4';
                }
                break;
            case 'editBlog':
                $id = firewall($_POST['id']);
                $title = firewall($_POST['title']);
                $ShortText = addslashes($_POST['shortText']);
                $longText = addslashes($_POST['longText']);
                $metaKeys = addslashes($_POST['metaKeys']);
                $status = firewall($_POST['status']);
                $ShortText = str_replace('<p>', '', $ShortText);
                $ShortText = str_replace('</p>', '', $ShortText);
                $longText = str_replace('<p>', '', $longText);
                $longText = str_replace('</p>', '', $longText);
                if ($title && $ShortText) {
                    $updateQueryString = "UPDATE MY_BLOG SET MetaKeys='$metaKeys', Active='$status', BlogShortDescription='$ShortText', BlogLongDescription='$longText', BlogTitle='$title' where BlogID='$id'";
                    $update = mysqliQuery($updateQueryString);
                    if ($update) {
                        echo $updateQueryString;
                    } else {
                        echo '3';
                    }
                } else
                    echo '2';
                break;
            case 'addCategory':
                $categoryName = firewall($_POST['categoryName']);
                if ($categoryName) {
                    $insert = mysqliQuery("INSERT INTO PROJECT_CATEGORIES(CategoryName) values ('$categoryName')");
                    $lastID = $mysqli->insert_id;
                    echo $lastID;
                } else {
                    echo '2';
                }
                break;
            case 'addEducation':
                $schoolName = firewall($_POST['schoolName']);
                $department = firewall($_POST['department']);
                $graduatedYear = firewall($_POST['graduatedYear']);
                if ($schoolName) {
                    $insert = mysqliQuery("INSERT INTO EDUCATIONS(SchoolName, Department, GraduatedYear) values ('$schoolName','$department','$graduatedYear')");
                    $lastID = $mysqli->insert_id;
                    echo '<tr id="educationTableItem' . $lastID . '"><td>' . $schoolName . '</td><td>' . $department . '</td><td>' . ($graduatedYear ? $graduatedYear : 'Continues') . '</td><td><a onclick="deleteEducation(\'' . $lastID . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td></tr>';
                } else
                    echo '2';
                break;
            case 'addExperience':
                $companyName = firewall($_POST['companyName']);
                $companyDescription = firewall($_POST['companyDescription']);
                $startMonth = firewall($_POST['startMonth']);
                $startYear = firewall($_POST['startYear']);
                $endMonth = firewall($_POST['endMonth']);
                $endYear = firewall($_POST['endYear']);

                if ($companyDescription && $companyName && $startMonth && $startYear) {
                    if ($endYear && !$endMonth || !$endYear && $endMonth) {
                        echo '3';
                    } elseif ($endYear && $endYear < $startYear) {
                        echo '4';
                    } else {
                        $insert = mysqliQuery("INSERT INTO EXPERIENCES(CompanyName, CompanyDescription, StartMonth, StartYear, EndMonth, EndYear) values ('$companyName','$companyDescription','$startMonth','$startYear','$endMonth','$endYear')");
                        $lastID = $mysqli->insert_id;
                        echo '<tr id="experienceTableItem' . $lastID . '">
							<td>' . $companyName . '</td>
							<td>' . $companyDescription . '</td>
							<td>' . changeMonthToString($startMonth) . ' ' . $startYear . '</td>
							<td>' . (($endMonth) ? changeMonthToString($endMonth) . ' ' . $endYear : 'Continues') . '</td>
							<td><a onclick="deleteExperience(\'' . $lastID . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
						  </tr>
						';
                    }
                } else {
                    echo '2';
                }
                break;
            case 'addProject':
                $category = firewall($_POST['projectCategory']);
                $title = firewall($_POST['projectTitle']);
                $ShortText = firewall($_POST['shortText']);
                $longText = $mysqli->real_escape_string(nl2br($_POST['longText']));
                if ($category && $title && $ShortText && $longText) {
                    if ($_FILES['projectImage']) {
                        $insert = mysqliQuery("INSERT INTO PROJECTS(CategoryID, ProjectName, ShortDescription, LongDescription) values ('$category','$title','$ShortText','$longText')");
                        $lastID = $mysqli->insert_id;
                        $sourcePath = $_FILES['projectImage']['tmp_name'];
                        $valid_extensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
                        $img = $_FILES['projectImage']['name'];
                        $tmp = $_FILES['projectImage']['tmp_name'];
                        $targetPath = 'assets/images/projects/p' . $lastID . '.jpg';
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        if (in_array($ext, $valid_extensions)) {
                            if (move_uploaded_file($tmp, $targetPath)) {
                                $longText = stripslashes($longText);
                                $selectCategory = query('CategoryName', 'CATEGORY', "CategoryID = '$category'");
                                echo '
                        <tr id="projectTableItem' . $lastID . '">
                            <td><a target="_blank" href="assets/images/projects/p' . $lastID . '.jpg">
                                <img width="100"
                                     src="assets/images/projects/p' . $lastID . '.jpg"
                                     alt="' . $title . '"
                                     class="img-responsive"/>
                            </td>
                            <td>' . $selectCategory['CategoryName'] . '</td>
                            <td>' . $title . '</td>
                            <td>' . $ShortText . '</td>
                            <td>' . $longText . '</td>
                            <td>
                                <a onclick="deleteProject(\'' . $lastID . '\');" class="btn btn-block btn-danger">
                                    <i class="fa fa-times"></i> Delete
                                </a>
                            </td>
                        </tr>
                        ';
                            } else {
                                mysqliQuery("delete from PROJECTS where CategoryID='$lastID'");
                                echo '4';
                            }
                        } else {
                            echo '3';
                        }
                    } else {
                        echo '2';
                    }
                } else {
                    echo '1';
                }
                break;
            case 'addReference':
                $referenceName = firewall($_POST['referenceName']);
                $referenceUrl = firewall($_POST['referenceUrl']);
                if ($_FILES['referenceImage'] && $referenceName) {
                    $insertQueryString = "INSERT INTO `MY_REFERENCES` (ReferenceName, URL, Date) values ('$referenceName','$referenceUrl',now())";
                    $insert = mysqliQuery($insertQueryString);
                    $lastID = $mysqli->insert_id;
                    $sourcePath = $_FILES['referenceImage']['tmp_name'];
                    $valid_extensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
                    $img = $_FILES['referenceImage']['name'];
                    $tmp = $_FILES['referenceImage']['tmp_name'];
                    $targetPath = 'assets/images/reference/r' . $lastID . '.jpg';
                    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                    if (in_array($ext, $valid_extensions)) {
                        if (move_uploaded_file($tmp, $targetPath)) {
                            echo '
                        <tr id="referenceTableItem' . $lastID . '">
                            <td><a target="_blank" href="assets/images/reference/r' . $lastID . '.jpg">
                                <img style="height: 110px; margin: auto;"
                                     src="assets/images/reference/r' . $lastID . '.jpg"
                                     alt="' . $referenceName . '"
                                     class="img-responsive"/>
                            </td>
                            <td>' . $referenceName . '</td>
                            <td>' . $referenceUrl . '</td>
                            <td>
                                <a onclick="deleteReference(\'' . $lastID . '\');" class="btn btn-block btn-danger">
                                    <i class="fa fa-times"></i> Sil
                                </a>
                             </td>
                        </tr>
                        ';
                        } else {
                            mysqliQuery("DELETE FROM `MY_REFERENCES` WHERE ReferenceID='$lastID'");
                            echo 'error update';
                        }
                    } else {
                        echo '3';
                    }
                } else
                    echo '4';
                break;
            case 'addSkill':
                $skillDescription = firewall($_POST['skillDescription']);
                $percent = firewall($_POST['percent']);
                if ($percent && $skillDescription) {
                    $insert = mysqliQuery("INSERT INTO SKILL(SkillDescription,Percent) values ('$skillDescription','$percent')");
                    $lastID = $mysqli->insert_id;
                    echo '<tr id="skillTableItem' . $lastID . '"><td>' . $skillDescription . '</td><td>' . $percent . '</td><td><a onclick="deleteSkill(\'' . $lastID . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td></tr>';
                } else {
                    echo '2';
                }
                break;

            case 'deleteAward':
                $awardID = firewall($_POST['awardID']);
                $deleteQuery = mysqliQuery("delete from AWARDS where AwardID = '$awardID'");
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'deleteBlog':
                $blogID = firewall($_POST['blogID']);
                $deleteQuery = mysqliQuery("delete from MY_BLOG where BlogID='$blogID'");
                if ($deleteQuery) {
                    echo '1';
                    $file_delete = dirname(__FILE__) . '/assets/images/blog/b' . $blogID . '.jpg';
                    unlink($file_delete);
                } else {
                    echo '2';
                }
                break;
            case 'deleteCategory':
                $categoryID = firewall($_POST['categoryID']);
                $deleteQuery = mysqliQuery("delete from PROJECT_CATEGORIES where CategoryID = '$categoryID'");
                if ($deleteQuery) {
                    mysqliQuery("delete from PROJECTS where CategoryID='$categoryID'");
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'deleteExperience':
                $experienceID = firewall($_POST['experienceID']);
                $deleteQuery = mysqliQuery("delete from EXPERIENCES where ExperiencesID = '$experienceID'");
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'deleteEducation':
                $educationID = firewall($_POST['educationID']);
                $deleteQuery = mysqliQuery("delete from EDUCATIONS where EducationID = '$educationID'");
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'deleteSkill':
                $skillID = firewall($_POST['skillID']);
                $deleteQuery = mysqliQuery("delete from SKILL where SkillID = '$skillID'");
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'deleteProject':
                $projectID = firewall($_POST['projectID']);
                $deleteQuery = mysqliQuery("delete from PROJECTS where ProjectID='$projectID'");
                if ($deleteQuery) {
                    echo '1';
                    $file_delete = dirname(__FILE__) . '/assets/images/projects/p' . $projectID . '.jpg';
                    unlink($file_delete);
                } else {
                    echo '2';
                }
                break;
            case 'deleteReference':
                $referenceID = firewall($_POST['referenceID']);
                $deleteQuery = mysqliQuery("delete from `MY_REFERENCES` where ReferenceID='$referenceID'");
                if ($deleteQuery) {
                    echo '1';
                    $file_delete = dirname(__FILE__) . '/assets/images/reference/r' . $referenceID . '.jpg';
                    unlink($file_delete);
                } else {
                    echo '2';
                }
                break;
            case 'deleteMessage':
                $messageID = firewall($_POST['messageID']);
                $deleteQuery = mysqliQuery("delete from INBOX where MessageID = '$messageID'");
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'deleteComment':
                $commentID = firewall($_POST['commentID']);
                $deleteQuery = mysqliQuery("DELETE FROM BLOG_COMMENT WHERE ID = '$commentID'");
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;

            case 'doActiveComment':
                $commentID = firewall($_POST['commentID']);
                $deleteQueryString = "UPDATE BLOG_COMMENT SET Status = 1 WHERE ID = '$commentID'";
                $deleteQuery = mysqliQuery($deleteQueryString);
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
            case 'doDeactivateComment':
                $commentID = firewall($_POST['commentID']);
                $deleteQueryString = "UPDATE BLOG_COMMENT SET Status = 0 WHERE ID = '$commentID'";
                $deleteQuery = mysqliQuery($deleteQueryString);
                if ($deleteQuery) {
                    echo '1';
                } else {
                    echo '2';
                }
                break;
        }
    }
}
