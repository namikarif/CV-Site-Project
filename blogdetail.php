<?php
include_once 'database.php';
include_once 'functions.php';

$_SESSION['Hex'] = $SiteSetting['Hex'];
$_SESSION['Theme'] = $SiteSetting['Theme'];
$_SESSION['Css'] = $SiteSetting['Css'];

$selectBlogDetailQuery = mysqliQuery("SELECT * from MY_BLOG where BlogID='" . firewall($_GET['id']) . "'");
$blogDetail = $selectBlogDetailQuery->fetch_array(MYSQLI_ASSOC);
$BlogReadCount = $blogDetail['Hint'] + 1;
$BlogID = $blogDetail['BlogID'];
$commentCount = query('count(1)', 'BLOG_COMMENT', 'BlogID = ' . $BlogID . ' AND Status = 1');
mysqliQuery("UPDATE MY_BLOG SET Hint = '$BlogReadCount' WHERE BlogID = '$BlogID'")
?>

<!DOCTYPE html>
<html lang="en" class="theme-color-<?= $SiteSetting['Hex'] ?> theme-skin-<?= $SiteSetting['Theme'] ?>">
<head>
    <title><?= $blogDetail['BlogTitle'] ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="<?= $blogDetail['MetaKeys'] ?>"/>
    <meta name="description" content="<?= $blogDetail['BlogShortDescription'] ?>">
    <meta name="author" content="<?= $SiteSetting['NameSurname'] ?>">
    <meta name="Copyright" content="Tufine">
    <meta name='language' content='TR'>
    <meta name="robots" content="index,follow">
    <meta property="og:image" content="assets/images/profile.jpg"/>
    <meta property="og:site_name" content="<?= $blogDetail['BlogTitle'] ?>"/>
    <meta property="og:description" content="<?= $blogDetail['BlogShortDescription'] ?>"/>
    <link rel="icon" href="assets/images/profile.jpg">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/map-icons/css/map-icons.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/icomoon/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/plugins/jquery.bxslider/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css"
          href="../assets/js/plugins/jquery.customscroll/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/plugins/jquery.mediaelement/mediaelementplayer.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/plugins/jquery.fancybox/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/plugins/jquery.owlcarousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/plugins/jquery.owlcarousel/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../assets/colors/<?= $SiteSetting['Css'] ?>.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/modernizr.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/googlemap.js"></script>
    <script type="text/javascript" src="../assets/fonts/map-icons/js/map-icons.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.appear.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.onepagenav.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript"
            src="../assets/js/plugins/jquery.customscroll/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript"
            src="../assets/js/plugins/jquery.mediaelement/mediaelement-and-player.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.fancybox/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.fancybox/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.owlcarousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../assets/js/options.js"></script>
    <script type="text/javascript" src="../assets/js/site.min.js"></script>
    <script type="text/javascript" src="../assets/js/message.js"></script>
    <link rel="stylesheet" href="../admin/plugins/toaster/toastr.min.css">
    <script src="../admin/plugins/toaster/toastr.min.js"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    <script>
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
    <base href="/">
</head>
<body class="post-template-default single single-post single-format-standard header-has-img  masthead-fixed page-single"
      data-gr-c-s-loaded="true" style="margin-right: 0px; margin-bottom: 0px;">

<div class="mobile-nav">
    <button class="btn-mobile mobile-nav-close"><i class="icon icon-close"></i></button>
    <div class="mobile-nav-inner">
        <nav id="mobile-nav" class="nav">
            <ul class="clearfix">
                <?php if ($SiteSetting['AboutMe'] == 1) echo '<li><a href="#aboutMe">About Me</a></li>'; ?>
                <?php $awardsQuery = query('count(1)', 'AWARDS'); if ($SiteSetting['Awards'] == 1 && $awardsQuery['count(1)'] > 0) echo '<li><a href="index#awards">My Awards</a></li>'; ?>
                <?php $skillsQuery = query('count(1)', 'SKILL'); if ($SiteSetting['Skills'] == 1 && $skillsQuery['count(1)'] > 0) echo '<li><a href="index#skill">Skills</a></li>'; ?>
                <?php $projectQuery = query('count(1)', 'PROJECTS'); if ($SiteSetting['Projects'] == 1 && $projectQuery['count(1)'] > 0) echo '<li><a href="index#projects">My Projects</a></li>'; ?>
                <?php $experiencesQuery = query('count(1)', 'EXPERIENCES'); if ($SiteSetting['Experiences'] == 1 && $experiencesQuery['count(1)'] > 0) echo '<li><a href="index#experiencea">Experiences</a></li>'; ?>
                <?php $educationsQuery = query('count(1)', 'EDUCATIONS'); if ($SiteSetting['Educations'] == 1 && $educationsQuery['count(1)'] > 0) echo '<li><a href="index#education">Education</a></li>'; ?>
                <?php $referencessQuery = query('count(1)', 'MY_REFERENCES'); if ($SiteSetting['References'] == 1 && $referencessQuery['count(1)'] > 0) echo '<li><a href="index#references">References</a></li>'; ?>
                <?php $my_blogQuery = query('count(1)', 'MY_BLOG', "Active = 1"); if ($SiteSetting['Blog'] == 1 && $my_blogQuery['count(1)'] > 0) echo '<li><a href="index#blog">My Blog Post</a></li>'; ?>
                <?php if ($SiteSetting['Message'] == 1) echo '<li><a href="index#contact">Contact</a></li>'; ?>
            </ul>
        </nav>
    </div>
</div>

<div class="wrapper">
    <header class="header">
        <div class="head-bg" style="background-image: url('assets/images/cover.jpg')"></div>
        <div class="head-bar">
            <div class="head-bar-inner">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-wrap">
                            <nav id="nav" class="nav">
                                <ul class="clearfix">
                                    <?php if ($SiteSetting['AboutMe'] == 1) echo '<li><a href="#aboutMe">About Me</a></li>'; ?>
                                    <?php $awardsQuery = query('count(1)', 'AWARDS'); if ($SiteSetting['Awards'] == 1 && $awardsQuery['count(1)'] > 0) echo '<li><a href="index#awards">My Awards</a></li>'; ?>
                                    <?php $skillsQuery = query('count(1)', 'SKILL'); if ($SiteSetting['Skills'] == 1 && $skillsQuery['count(1)'] > 0) echo '<li><a href="index#skill">Skills</a></li>'; ?>
                                    <?php $projectQuery = query('count(1)', 'PROJECTS'); if ($SiteSetting['Projects'] == 1 && $projectQuery['count(1)'] > 0) echo '<li><a href="index#projects">My Projects</a></li>'; ?>
                                    <?php $experiencesQuery = query('count(1)', 'EXPERIENCES'); if ($SiteSetting['Experiences'] == 1 && $experiencesQuery['count(1)'] > 0) echo '<li><a href="index#experiencea">Experiences</a></li>'; ?>
                                    <?php $educationsQuery = query('count(1)', 'EDUCATIONS'); if ($SiteSetting['Educations'] == 1 && $educationsQuery['count(1)'] > 0) echo '<li><a href="index#education">Education</a></li>'; ?>
                                    <?php $referencesQuery = query('count(1)', 'MY_REFERENCES'); if ($SiteSetting['MyReferences'] == 1 && $referencessQuery['count(1)'] > 0) echo '<li><a href="index#references">References</a></li>'; ?>
                                    <?php $my_blogQuery = query('count(1)', 'MY_BLOG', "Active = 1"); if ($SiteSetting['Blog'] == 1 && $my_blogQuery['count(1)'] > 0) echo '<li><a href="index#blog">My Blog Post</a></li>'; ?>
                                    <?php if ($SiteSetting['Message'] == 1) echo '<li><a href="index#contact">Contact</a></li>'; ?>
                                </ul>
                            </nav>

                            <button class="btn-mobile btn-mobile-nav">Menu</button>
                            <button class="btn-sidebar btn-sidebar-open"><i class="icon icon-menu"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <main class="post-single">
                        <article
                                class="post-492 post type-post status-publish format-standard has-post-thumbnail hentry category-interesting category-my-personal category-uncategorized tag-b-voice tag-interesting tag-story tag-universe post-content section-box">
                            <div class="post-media">
                                <img src="assets/images/blog/b<?= $BlogID ?>.jpg"
                                     alt="<?= $blogDetail['BlogTitle'] ?>">
                            </div>
                            <div class="post-inner">
                                <header class="post-header">
                                    <div class="post-data">

                                        <div class="post-title-wrap">
                                            <h1 class="post-title"><?= $blogDetail['BlogTitle'] ?></h1>
                                            <time class="post-datetime" datetime="<?= $blogDetail['Date'] ?>">
                                                <span class="day"><?= substr($blogDetail['Date'], 8, 2) ?></span>
                                                <span class="month"><?= substr(mb_strtoupper(getMonths(substr($blogDetail['Date'], 5, 2), 'utf-8')), 0, 3) ?></span>
                                            </time>
                                        </div>

                                        <div class="post-info">
                                            <a>
                                                <i class="icon icon-comments"></i> <?= $commentCount['count(1)'] ?>
                                            </a>
                                            <a>
                                                <i class="icon icon-eye"></i> <?= $blogDetail['Hint'] ?>
                                            </a>
                                        </div>
                                    </div>
                                </header>

                                <div class="post-editor clearfix">
                                    <div id="text">
                                        <?= $blogDetail['BlogLongDescription'] ?>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <div class="blog-comments">
                            <ul class="timeline">
                                <?php $selectCommentQuery = mysqliQuery("SELECT * FROM BLOG_COMMENT WHERE BlogID = '$BlogID' AND Status = 1");
                                while ($commentList = $selectCommentQuery->fetch_assoc()) { ?>
                                    <li id="commentTable<?= $commentList['ID'] ?>">
                                        <div class="timeline-item">
                                            <span class="time"> <?php echo ActiveDate(date($commentList['CommentDate'])) ?></span>

                                            <h3 class="timeline-header"><a><?= $commentList['Name'] ?></a> commented</h3>

                                            <div class="timeline-body">
                                                <?= $commentList['Comment'] ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="post-comments animate-up" id="comments">
                            <!--                            <h2 class="section-title">Comments -->
                            <? //= count($commentList) ?><!--</h2>-->
                            <div class="section-box">
                                <div id="respond" class="comment-respond">
                                    <form id="commentForm" class="comment-form" novalidate>
                                        <div class="input-field">
                                            <textarea id="comment"
                                                      rows="4"
                                                      name="comment"
                                                      class="form-control"
                                                      aria-required="true"
                                                      spellcheck="false"></textarea>
                                            <span class="line"></span>
                                            <label for="comment">Type Comment Here *</label>
                                        </div>
                                        <div class="input-field">
                                            <input type="text" class="form-control" id="name" name="commentName"
                                                   value=""
                                                   aria-required="true">
                                            <span class="line"></span>
                                            <label>Name *</label>
                                        </div>
                                        <div class="input-field">
                                            <input type="email" class="form-control" id="email" name="commentEmail"
                                                   value=""
                                                   aria-required="true">
                                            <span class="line"></span>
                                            <label>Email *</label>
                                        </div>
                                        <div class="input-field">
                                            <input type="text" class="form-control" id="website" name="commentWebsite"
                                                   value="">
                                            <span class="line"></span>
                                            <label>Website</label>
                                        </div>
                                        <p class="form-submit">
                                            <span class="btn-outer btn-primary-outer ripple">
                                                <input class="btn btn-lg btn-primary"
                                                       name="submit"
                                                       type="button"
                                                       onclick="addComment(<?= $BlogID ?>)"
                                                       value="Leave Comment">
                                            </span>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <!--                Sidebar -->
                <div class="col-sm-4">
                    <div class="sidebar sidebar-default">
                        <div class="widget-area">
                            <aside class="widget widget_recent_entries last-post">
                                <h2 class="widget-title">Recent Posts</h2>
                                <ul>
                                    <?php
                                    $selectLastBlogListQuery = mysqliQuery("SELECT * FROM MY_BLOG WHERE BlogID <> '$BlogID' LIMIT 10");
                                    while ($selectLastBlogList = $selectLastBlogListQuery->fetch_array(MYSQLI_ASSOC)) {
                                        echo '<li>
                                                 <a href="https://blog.tufine.com.tr/blog/' . $selectLastBlogList['BlogID'] . '">
                                                    ' . $selectLastBlogList['BlogTitle'] . '
                                                 </a>
                                              </li>';
                                    } ?>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <?php if ($GeneralInformation['Facebook'] || $GeneralInformation['Twitter'] || $GeneralInformation['Skype'] || $GeneralInformation['Linkedin'] || $GeneralInformation['Tumblr'] || $GeneralInformation['Youtube'] || $GeneralInformation['Instagram']) { ?>
            <div class="footer-social">
                <ul class="social">
                    <?php
                    if ($GeneralInformation['Facebook'])
                        echo '<li><a class="ripple-centered" href="https://www.facebook.com/' . $GeneralInformation['Facebook'] . '" target="_blank"><i class="icon icon-facebook"></i></a></li>';

                    if ($GeneralInformation['Twitter'])
                        echo '<li><a class="ripple-centered" href="https://www.twitter.com/' . $GeneralInformation['Twitter'] . '" target="_blank"><i class="icon icon-twitter"></i></a></li>';

                    if ($GeneralInformation['Instagram'])
                        echo '<li><a class="ripple-centered" href="https://www.instagram.com/' . $GeneralInformation['Instagram'] . '" target="_blank"><i class="icon icon-instagram"></i></a></li>';

                    if ($GeneralInformation['Skype'])
                        echo '<li><a class="ripple-centered" onclick="swal(\'Skype\',\'' . $GeneralInformation['Skype'] . '\',\'success\');" title="' . $GeneralInformation['Skype'] . '" href="skype:' . $GeneralInformation['Skype'] . '?' . $GeneralInformation['SkypeConnectionType'] . '"><i class="icon icon-skype"></i></a></li> ';

                    if ($GeneralInformation['Tumblr'])
                        echo '<li><a class="ripple-centered" href="https://' . $GeneralInformation['Tumblr'] . '.tumblr.com" target="_blank"><i class="icon icon-tumblr"></i></a></li>';

                    if ($GeneralInformation['Youtube'])
                        echo '<li><a class="ripple-centered" href="https://www.youtube.com/' . $GeneralInformation['Youtube'] . '" target="_blank"><i class="icon icon-youtube"></i></a></li>';

                    if ($GeneralInformation['Linkedin'])
                        echo '<li><a class="ripple-centered" href="https://www.linkedin.com/in/' . $GeneralInformation['Linkedin'] . '" target="_blank"><i class="icon icon-linkedin"></i></a></li>';
                    ?>
                </ul>
            </div>
        <?php } ?>
    </footer>
</div>
<a class="btn-scroll-top" href="#"><i class="icon icon-arrow-up"></i></a>
<div id="overlay"></div>
<div id="preloader">
    <div class="preload-icon"><span></span><span></span></div>
    <div class="preload-text">Loading...</div>
</div>
</body>
