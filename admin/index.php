<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    include 'login.php';
    exit;
}
include_once '../database.php';
include_once '../functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CV Management Panel</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="admin/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="icon" href="../assets/images/profile.jpg">
    <script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/sweetalert.css">
    <script src="../assets/js/custom.js"></script>
    <link rel="stylesheet" href="admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="admin/plugins/toaster/toastr.min.css">
    <script src="admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="admin/plugins/toaster/toastr.min.js"></script>

    <script>
        $(function () {
            $('textarea').wysihtml5();
        });
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="admin" class="logo">
            <span class="logo-mini"><b>C</b>V</span>
            <span class="logo-lg"><b>CV</b> Administration</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img id="profilePictureIcon" src="../assets/images/profile.jpg" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs"><?= $GeneralInformation['NameSurname'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img id="profilePictureSidebar" src="../assets/images/profile.jpg" class="img-circle"
                                     alt="User Image">
                                <p>
                                    <?= $GeneralInformation['NameSurname'] ?>
                                    <small><?= $GeneralInformation['ShortText'] ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="../" target="_blank" class="btn btn-default btn-flat">Show
                                        Site</a>
                                </div>
                                <div class="pull-right">
                                    <a href="javascript:void(0);" onclick="exit();" class="btn btn-default btn-flat">Exit</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img id="profilePicture" src="../assets/images/profile.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $GeneralInformation['NameSurname'] ?></p>
                    <span><?= $GeneralInformation['ShortText'] ?></span>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">SITE TOOLS</li>
                <li <?= (isset($_GET['page']) ? ($_GET['page'] == 'homepage' ? 'class="active"' : '') : 'class="active"') ?>>
                    <a href="admin">
                        <i class="fa fa-home"></i>
                        <span>Home Page</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'sitesettings') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/sitesettings">
                        <i class="fa fa-globe"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'generalinfo') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/generalinfo">
                        <i class="fa fa-cogs"></i>
                        <span>General Info</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'blog') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/blog">
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Blog</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'education') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/education">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Educations</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'experiences') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/experiences">
                        <i class="fa fa-briefcase"></i>
                        <span>Experiences</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'skill') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/skill">
                        <i class="fa fa-child"></i>
                        <span>Skills</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'projects') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/projects">
                        <i class="fa fa-list-ul"></i> <span>Projects</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'award') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/award">
                        <i class="fa fa-trophy"></i>
                        <span>Awards</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'reference') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/reference">
                        <i class="fa fa-user-md"></i>
                        <span>References</span>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'message') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/message">
                        <i class="fa fa-envelope-o"></i>
                        <span>Messages</span>
                        <?php $messageQuery = query('count(1)', 'INBOX', "Status = 1"); echo $messageQuery['count(1)'] > 0 ? '<span class="pull-right-container"><small class="label pull-right bg-red">' . $messageQuery['count(1)'] . '</small></span>' : '' ?>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'referer') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/referer">
                        <i class="fa fa-external-link"></i>
                        <span>Referers</span>
                        <?php $refererQuery = query('count(1)', 'SITE_LOGS', "RefererURL <> 'Indefinite / Direct' and Status = 1"); echo $refererQuery['count(1)'] > 0 ? '<span class="pull-right-container"><small class="label pull-right bg-red">' . $refererQuery['count(1)'] . '</small></span>' : '' ?>
                    </a>
                </li>
                <li <?= (isset($_GET['page']) ? (($_GET['page'] == 'blockedip') ? 'class="active"' : '') : '') ?>>
                    <a href="admin/blockedip">
                        <i class="fa fa-ban"></i>
                        <span>Blocked IP</span>
                    </a>
                </li>
                <li class="header">OTHERS</li>
                <li>
                    <a href="https://namikarifoglu.com" target="_blank">
                        <i class="fa fa-globe"></i>
                        <span>Show Site</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="exit()">
                        <i class="fa fa-sign-out"></i>
                        <span>Exit</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <?php
            if (isset($_GET['page'])) {
                $name = firewall($_GET['page']);
                if (file_exists('page/' . $name . '.php')) {
                    include("page/$name.php");
                } else {
                    include("page/notfound.php");
                }
            } else {
                include("page/homepage.php");
            }
            ?>
        </section>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; <?= date('Y') ?> <a href="http://www.tufine.com.tr">Tufine</a>.</strong> All Rights
        Reserved.
    </footer>
</div>
<div class="loader-container" id="loader">
    <div class="loader">
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__ball"></div>
    </div>
</div>
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<script src="admin/dist/js/app.min.js"></script>
</body>
</html>
