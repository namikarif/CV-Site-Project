<?php
include_once 'database.php';
include_once 'functions.php';

$_SESSION['Hex'] = $SiteSetting['Hex'];
$_SESSION['Theme'] = $SiteSetting['Theme'];
$_SESSION['Css'] = $SiteSetting['Css'];
?>
<!DOCTYPE html>
<html lang="en" class="theme-color-<?= $SiteSetting['Hex'] ?> theme-skin-<?= $SiteSetting['Theme'] ?>">
<head>
    <title><?= $SiteSetting['SiteTitle'] ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="<?= $SiteSetting['MetaKeys'] ?>"/>
    <meta name="description" content="<?= $SiteSetting['Description'] ?>">
    <meta name="author" content="<?= $GeneralInformation['NameSurname'] ?>">
    <meta name="Copyright" content="<?= $GeneralInformation['NameSurname'] ?>">
    <meta name='language' content='TR'>
    <meta name="robots" content="index,follow">
    <meta property="og:image" content="assets/images/profile.jpg"/>
    <meta property="og:site_name" content="<?= $SiteSetting['SiteTitle'] ?>"/>
    <meta property="og:description" content="<?= $SiteSetting['Description'] ?>"/>
    <link rel="icon" href="assets/images/profile.jpg">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">
    <link rel="stylesheet" type="text/css" href="assets/fonts/map-icons/css/map-icons.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/icomoon/style.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/jquery.bxslider/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/jquery.customscroll/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/jquery.mediaelement/mediaelementplayer.min.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/jquery.fancybox/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/jquery.owlcarousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/jquery.owlcarousel/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/colors/<?= $SiteSetting['Css'] ?>.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script type="text/javascript" src="assets/js/libs/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/googlemap.js"></script>
    <script type="text/javascript" src="assets/fonts/map-icons/js/map-icons.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.appear.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.onepagenav.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript"
            src="assets/js/plugins/jquery.customscroll/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.mediaelement/mediaelement-and-player.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.fancybox/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.fancybox/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="assets/js/plugins/jquery.owlcarousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/js/options.js"></script>
    <script type="text/javascript" src="assets/js/site.min.js"></script>
    <script type="text/javascript" src="assets/js/message.js"></script>
    <script type="text/javascript">

        // owl-carousel
        $('.owl-carousel').owlCarousel({
            items: 6,
            nav: true,
            dots: false,
            mouseDrag: true,
            responsiveClass: true
        });

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('body').toggleClass('sidebar-open');
                $(this).toggleClass('active');
            });
        });
    </script>
    <base href="https://namikarifoglu.com">
</head>

<body class="home header-has-img loading">
<div class="mobile-nav">
    <button class="btn-mobile mobile-nav-close"><i class="icon icon-close"></i></button>
    <div class="mobile-nav-inner">
        <nav id="mobile-nav" class="nav">
            <ul class="clearfix">
                <?php if ($SiteSetting['AboutMe'] == 1) { echo '<li><a href="#aboutMe">About Me</a></li>'; } ?>
                <?php if ($SiteSetting['Educations'] == 1 && query('count(1)', 'EDUCATIONS') > 0) { echo '<li><a href="#education">Education</a></li>'; } ?>
                <?php if ($SiteSetting['Skills'] == 1 && query('count(1)', 'SKILL') > 0) { echo '<li><a href="#skill">Skills</a></li>'; } ?>
                <?php if ($SiteSetting['Experiences'] == 1 && query('count(1)', 'EXPERIENCES') > 0) { echo '<li><a href="#experiencea">Experiences</a></li>'; } ?>
                <?php if ($SiteSetting['Awards'] == 1 && query('count(1)', 'AWARDS') > 0) { echo '<li><a href="#awards">My Awards</a></li>'; } ?>
                <?php if ($SiteSetting['Projects'] == 1 && query('count(1)', 'PROJECTS') > 0) { echo '<li><a href="#projects">My Projects</a></li>'; } ?>
                <?php if ($SiteSetting['MyReferences'] == 1 && query('count(1)', 'MY_REFERENCES') > 0) { echo '<li><a href="#references">References</a></li>'; } ?>
                <?php if ($SiteSetting['Blog'] == 1 && query('count(1)', 'MY_BLOG', "Active = 1") > 0) { echo '<li><a href="#blog">My Blog Post</a></li>'; } ?>
                <?php if ($SiteSetting['Message'] == 1) { echo '<li><a href="#contact">Contact</a></li>'; } ?>
            </ul>
        </nav>
    </div>
</div>
<div class="sidebar sidebar-fixed">
    <button class="btn-sidebar btn-sidebar-close"><i class="icon icon-close"></i></button>
    <div class="widget-area">
        <aside class="widget widget-profile">
            <div class="profile-photo">
                <img src="assets/images/profile.jpg" alt="<?= $GeneralInformation['NameSurname'] ?>"/>
            </div>
            <div class="profile-info">
                <h2 class="profile-title"><?= $GeneralInformation['NameSurname'] ?></h2>

                <h3 class="profile-position"><?= $GeneralInformation['ShortText'] ?></h3>
            </div>
        </aside>
        <?php if ($SiteSetting['Message'] == 1) { ?>
            <aside class="widget widget_contact">
                <h2 class="widget-title">Contact me</h2>
                <form class="rsForm" onsubmit="return false;" method="post">
                    <div class="input-field">
                        <label>Name Surname</label>
                        <input type="text" name="name" value="">
                        <span class="line"></span>
                    </div>
                    <div class="input-field">
                        <label>E-Mail</label>
                        <input type="email" name="email" value="">
                        <span class="line"></span>
                    </div>

                    <div class="input-field">
                        <label>Phone</label>
                        <input type="text" name="telephone" value="">
                        <span class="line"></span>
                    </div>

                    <div class="input-field">
                        <label>Message</label>
                        <textarea rows="4" name="message"></textarea>
                        <span class="line"></span>
                    </div>

                    <span class="btn-outer btn-primary-outer ripple">
                        <input onclick="sendMessage2();" class="rsFormSubmit btn btn-lg btn-primary" type="submit"
                               value="Send">
                    </span>
                </form>
            </aside>
        <?php } ?>
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
                                    <?php if ($SiteSetting['AboutMe'] == 1) { echo '<li><a href="#aboutMe">About Me</a></li>'; } ?>
                                    <?php if ($SiteSetting['Educations'] == 1 && query('count(1)', 'EDUCATIONS') > 0) { echo '<li><a href="#education">Education</a></li>'; } ?>
                                    <?php if ($SiteSetting['Skills'] == 1 && query('count(1)', 'SKILL') > 0) { echo '<li><a href="#skill">Skills</a></li>'; } ?>
                                    <?php if ($SiteSetting['Experiences'] == 1 && query('count(1)', 'EXPERIENCES') > 0) { echo '<li><a href="#experience">Experiences</a></li>'; } ?>
                                    <?php if ($SiteSetting['Awards'] == 1 && query('count(1)', 'AWARDS') > 0) { echo '<li><a href="#awards">My Awards</a></li>'; } ?>
                                    <?php if ($SiteSetting['Projects'] == 1 && query('count(1)', 'PROJECTS') > 0) { echo '<li><a href="#projects">My Projects</a></li>'; } ?>
                                    <?php if ($SiteSetting['MyReferences'] == 1 && query('count(1)', 'MY_REFERENCES') > 0) { echo '<li><a href="#references">References</a></li>'; } ?>
                                    <?php if ($SiteSetting['Blog'] == 1 && query('count(1)', 'MY_BLOG', "Active = 1") > 0) { echo '<li><a href="#blogPost">My Blog Post</a></li>'; } ?>
                                    <?php if ($SiteSetting['Message'] == 1) { echo '<li><a href="#contact">Contact</a></li>'; } ?>
                                </ul>
                            </nav>

                            <button class="btn-mobile btn-mobile-nav">Menu</button>
                            <!--<button class="btn-sidebar btn-sidebar-open"><i class="icon icon-menu"></i></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <section id="aboutMe" class="section section-about">
                <div class="animate-up">
                    <div class="section-box">
                        <div class="profile">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="profile-photo">
                                        <img src="assets/images/profile.jpg"
                                             alt="<?= $GeneralInformation['NameSurname'] ?>"/>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="profile-info">
                                        <div class="profile-preword">
                                            <span><?= $GeneralInformation['HeaderText'] ?></span></div>
                                        <h1 class="profile-title">
                                            <span>I'm</span> <?= $GeneralInformation['NameSurname'] ?></h1>
                                        <h2 class="profile-position"><?= $GeneralInformation['ShortText'] ?></h2></div>
                                    <ul class="profile-list">
                                        <li class="clearfix">
                                            <strong class="title">Phone</strong>
                                            <span class="cont">
                                                <a href="tel:<?= str_replace(' ', '', $GeneralInformation['Phone']) ?>"><?= $GeneralInformation['Phone'] ?></a>
                                            </span>
                                        </li>
                                        <li class="clearfix">
                                            <strong class="title">Address</strong>
                                            <span class="cont"><?= $GeneralInformation['Address'] ?></span>
                                        </li>
                                        <li class="clearfix">
                                            <strong class="title">E-mail</strong>
                                            <span class="cont">
                                                <a href="mailto:<?= $GeneralInformation['EMail'] ?>"><?= $GeneralInformation['EMail'] ?></a>
                                            </span>
                                        </li>
                                        <li class="clearfix">
                                            <strong class="title">Birth Day</strong>
                                            <span class="cont"><?= $GeneralInformation['BirthDate'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($GeneralInformation['Facebook'] || $GeneralInformation['Twitter'] || $GeneralInformation['Skype'] || $GeneralInformation['Linkedin'] || $GeneralInformation['Tumblr'] || $GeneralInformation['Youtube'] || $GeneralInformation['Instagram']) {
                            ?>
                            <div class="profile-social">
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
                    </div>
                    <div class="section-txt-btn">
                        <p><?= stripslashes($GeneralInformation['AboutMe']) ?></p>
                    </div>
                </div>
            </section>
            <?php if ($SiteSetting['Educations'] == 1 && query('count(1)', 'EDUCATIONS') > 0) { ?>
                <section id="education" class="section section-education">
                    <div class="animate-up">
                        <h2 class="section-title">Education</h2>
                        <div class="timeline">
                            <div class="timeline-bar"></div>
                            <div class="timeline-inner clearfix">
                                <?php
                                $line = 0;
                                $continuesEducation = mysqliQuery("SELECT SchoolName, Department from EDUCATIONS where GraduatedYear = '' or GraduatedYear is null order by GraduatedYear DESC");
                                while ($continuesEducationList = $continuesEducation->fetch_array(MYSQLI_ASSOC)) {
                                    if ($line % 2 == 0) {
                                        $class1 = 'left';
                                        $class2 = 'right';
                                    } else {
                                        $class1 = 'right';
                                        $class2 = 'left';
                                    }
                                    echo '<div class="timeline-box timeline-box-compact timeline-box-' . $class1 . '">
                                        <span class="dot"></span>

                                        <div class="timeline-box-inner animate-' . $class2 . '">
                                            <span class="arrow"></span>

                                            <div class="date"><span>Continues</span></div>
                                            <h3>' . $continuesEducationList['SchoolName'] . '</h3>
                                            <h4>' . $continuesEducationList['Department'] . '</h4>
                                        </div>
                                    </div>';
                                    $line++;
                                }


                                $selectEducation = mysqliQuery("SELECT SchoolName, Department, GraduatedYear from EDUCATIONS where GraduatedYear <> '' order by GraduatedYear DESC");
                                while ($educationList = $selectEducation->fetch_array(MYSQLI_ASSOC)) {

                                    if ($line % 2 == 0) {
                                        $class1 = 'left';
                                        $class2 = 'right';
                                    } else {
                                        $class1 = 'right';
                                        $class2 = 'left';
                                    }
                                    echo '<div class="timeline-box timeline-box-compact timeline-box-' . $class1 . '">
                                        <span class="dot"></span>

                                        <div class="timeline-box-inner animate-' . $class2 . '">
                                            <span class="arrow"></span>

                                            <div class="date"><span>' . $educationList['GraduatedYear'] . '</span></div>
                                            <h3>' . $educationList['SchoolName'] . '</h3>
                                            <h4>' . $educationList['Department'] . '</h4>
                                        </div>
                                    </div>';
                                    $line++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['Skills'] == 1 && query('count(1)', 'SKILL') > 0) { ?>
                <section id="skill" class="section section-skill">
                    <div class="animate-up">
                        <h2 class="section-title">Skills</h2>
                        <div class="section-box">
                            <?php
                            $skill = mysqliQuery("SELECT SkillDescription, Percent from SKILL order by Percent DESC");
                            $line = 0;
                            if ($skill->num_rows == 1) {
                                $skill = $skill->fetch_array(MYSQLI_ASSOC);
                                echo '<div class="row">
                                        <div class="col-sm-12">
                                            <div class="progress-bar">
                                                <div class="bar-data">
                                                    <span class="bar-title">' . $skill['SkillDescription'] . '</span>
                                                    <span class="bar-value">' . $skill['Percent'] . '%</span>
                                                </div>
                                                <div class="bar-line">
                                                    <span class="bar-fill" data-width="' . $skill['Percent'] . '%"></span>
                                                </div>
                                            </div>
                                        </div>
                                     </div>';
                            } else {
                                while ($skillList = $skill->fetch_array(MYSQLI_ASSOC)) {
                                    $line++;
                                    if ($line % 2 == 1)
                                        echo '<div class="row">';

                                    echo '<div class="col-sm-6">
                                            <div class="progress-bar">
                                                <div class="bar-data">
                                                    <span class="bar-title">' . $skillList['SkillDescription'] . '</span>
                                                    <span class="bar-value">' . $skillList['Percent'] . '%</span>
                                                </div>
                                                <div class="bar-line">
                                                    <span class="bar-fill" data-width="' . $skillList['Percent'] . '%"></span>
                                                </div>
                                            </div>
                                        </div>';

                                    if ($line % 2 == 0)
                                        echo '</div>';
                                }
                                if ($skill->num_rows % 2 == 1)
                                    echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['Experiences'] == 1 && query('count(1)', 'EXPERIENCES') > 0) { ?>
                <section id="experience" class="section section-experience">
                    <div class="animate-up">
                        <h2 class="section-title">Experiences</h2>
                        <div class="timeline">
                            <div class="timeline-bar"></div>
                            <div class="timeline-inner clearfix">
                                <?php
                                $selectExperiences = mysqliQuery("SELECT * from EXPERIENCES order by StartYear DESC, StartMonth DESC");
                                $line = 0;
                                while ($experienceList = $selectExperiences->fetch_array(MYSQLI_ASSOC)) {
                                    $line++;
                                    if ($line % 2 == 1) {
                                        $class1 = 'left';
                                        $class2 = 'right';
                                    } else {
                                        $class1 = 'right';
                                        $class2 = 'left';
                                    }
                                    echo '
                                    <div class="timeline-box timeline-box-' . $class1 . '">
                                        <span class="dot"></span>

                                        <div class="timeline-box-inner animate-' . $class2 . '">
                                            <span class="arrow"></span>

                                            <div class="date">' . changeMonthToString($experienceList['StartMonth']) . ' ' . $experienceList['StartYear'] . ' ' . (($experienceList['EndMonth'] || $experienceList['EndYear'] > 0) ? ' - ' . changeMonthToString($experienceList['EndMonth']) . ' ' . $experienceList['EndYear'] : 'Continues') . '</div>
                                            <h3>' . $experienceList['CompanyName'] . '</h3>
                                            <h4>' . $experienceList['CompanyDescription'] . '</h4>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['Awards'] == 1 && query('count(1)', 'AWARDS') > 0) { ?>
                <section id="awards" class="section section-experience">
                    <div class="animate-up">
                        <h2 class="section-title">My Awards</h2>
                        <div class="timeline">
                            <div class="timeline-bar"></div>
                            <div class="timeline-inner clearfix">
                                <?php
                                $awards = mysqliQuery("SELECT AwardDescription, AwardYear from AWARDS order by AwardYear DESC");
                                $line = 0;
                                while ($awardsList = $awards->fetch_array(MYSQLI_ASSOC)) {
                                    $line++;
                                    if ($line % 2 == 1) {
                                        $class1 = 'left';
                                        $class2 = 'right';
                                    } else {
                                        $class1 = 'right';
                                        $class2 = 'left';
                                    }
                                    echo '
                                    <div class="timeline-box timeline-box-' . $class1 . '">
                                        <span class="dot"></span>
                                        <div class="timeline-box-inner animate-' . $class2 . '">
                                            <span class="arrow"></span>
                                            <div class="date">' . $awardsList['AwardDescription'] . '</div>
                                            <h3>' . $awardsList['AwardYear'] . '</h3>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['Projects'] == 1 && query('count(1)', 'PROJECTS') > 0) { ?>
                <section id="projects" class="section section-portfolio">
                    <div class="animate-up">
                        <h2 class="section-title">Projects</h2>
                        <div class="filter">
                            <div class="filter-inner">
                                <div class="filter-btn-group">
                                    <button data-filter="*">All</button>
                                    <?php
                                    $selectProjectCategory = mysqliQuery("SELECT * from PROJECT_CATEGORIES order by CategoryName ASC");
                                    while ($projectCategoryList = $selectProjectCategory->fetch_array(MYSQLI_ASSOC)) {
                                        echo '<button data-filter=".kat' . $projectCategoryList['CategoryID'] . '">' . $projectCategoryList['CategoryName'] . '</button>';
                                    }
                                    ?>
                                </div>
                                <div class="filter-bar">
                                    <span class="filter-bar-line"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="grid-sizer"></div>
                            <?php
                            $selectProjectCategory2 = mysqliQuery("SELECT * from PROJECT_CATEGORIES order by CategoryName ASC");
                            while ($projectCategoryList2 = $selectProjectCategory2->fetch_array(MYSQLI_ASSOC)) {
                                $selectProjectImages = mysqliQuery("SELECT ProjectID, ProjectName, ShortDescription, LongDescription from PROJECTS where CategoryID='{$projectCategoryList2['CategoryID']}' order by ProjectID DESC");
                                if ($selectProjectImages->num_rows > 0) {
                                    while ($row = $selectProjectImages->fetch_array(MYSQLI_ASSOC)) {
                                        echo '
                                        <div class="grid-item size11 kat' . $projectCategoryList2['CategoryID'] . '">
                                            <div class="grid-box">
                                                <figure class="portfolio-figure">
                                                    <img src="assets/images/projects/p' . $row['ProjectID'] . '.jpg" alt="' . $row['ProjectName'] . '"/>
                                                    <figcaption class="portfolio-caption">
                                                        <div class="portfolio-caption-inner">
                                                            <h3 class="portfolio-title">' . $row['ProjectName'] . '</h3>
                                                            <h4 class="portfolio-cat">' . $row['ShortDescription'] . '</h4>
                                                            <div class="btn-group">
                                                                <a class="portfolioFancybox btn-zoom" data-fancybox-group="portfolioFancybox2"
                                                                   href="#projectDetail' . $row['ProjectID'] . '">
                                                                    <i class="icon icon-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                                <div id="projectDetail' . $row['ProjectID'] . '" class="fancybox-inline-box">
                                                    <div class="inline-embed" data-embed-type="image"
                                                         data-embed-url="assets/images/projects/p' . $row['ProjectID'] . '.jpg"></div>
                                                    <div class="inline-cont">
                                                        <h2 class="inline-title">' . $row['ProjectName'] . '</h2>
                                        
                                                        <div class="inline-text">
                                                            <p>' . $row['LongDescription'] . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['MyReferences'] == 1 && query('count(1)', 'MY_REFERENCES') > 0) { ?>
                <section id="references" class="section section-clients">
                    <div class="animate-up">
                        <h2 class="section-title">References</h2>
                        <div class="clients-carousel">
                            <?php
                            $selectReferences = mysqliQuery("SELECT ReferenceID, URL, ReferenceName from `MY_REFERENCES` order by Date DESC");
                            while ($ref = $selectReferences->fetch_array(MYSQLI_ASSOC)) {
                                echo '<div class="client-logo">
                                    ' . (($ref['URL']) ? '<a href="' . $ref['URL'] . '" target="_blank">' : '') . '<img src="assets/images/reference/r' . $ref['ReferenceID'] . '.jpg" title="' . $ref['ReferenceName'] . '" alt="' . $ref['ReferenceName'] . '"/>' . (($ref['URL']) ? '</a>' : '') . '
                                </div>';
                            }
                            ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['Blog'] == 1 && query('count(1)', 'MY_BLOG') > 0) { ?>
                <section id="blogPost" class="section section-blog">
                    <div class="animate-up">
                        <h2 class="section-title">My Blog Post</h2>
                        <div class="blog-grid">
                            <div class="grid-sizer"></div>
                            <div class="blog-carousel">
                                <?php
                                $selectBlogPost = mysqliQuery("SELECT * from MY_BLOG where Active = 1 order by Date DESC");
                                while ($blogPostList = $selectBlogPost->fetch_array(MYSQLI_ASSOC)) {
                                    $commentCountQuery = query('count(1)', 'BLOG_COMMENT', 'BlogID = ' . $blogPostList['BlogID'] . ' AND Status = 1');
                                    $haveImage = "";
                                    if (file_exists('assets/images/blog/b' . $blogPostList['BlogID'] . '.jpg'))
                                        $haveImage = 1;

                                    echo '<div class="grid-item">
                                    <article class="post-box">';
                                    if ($haveImage == 1) {
                                        echo '<div class="post-media">
                                            <div class="post-image">
                                                <a ' . (($blogPostList['BlogLongDescription']) ? 'class="portfolioFancybox" href="blog/' . $blogPostList['BlogID'] . '"' : 'href="javascript:void(0);"') . '><img src="assets/images/blog/b' . $blogPostList['BlogID'] . '.jpg" alt="' . $blogPostList['BlogTitle'] . '"> </a>
                                            </div>
                                        </div>';
                                    }
                                    echo '
                                        <div class="post-data">
                                            <time class="post-datetime" datetime="' . $blogPostList['Date'] . '">
                                                <span class="day">' . substr($blogPostList['Date'], 8, 2) . '</span>
                                                <span class="month">' . substr(mb_strtoupper(getMonths(substr($blogPostList['Date'], 5, 2), 'utf-8')), 0, 3) . '</span>
                                            </time>
                                            <h3 class="post-title">
                                                <a ' . (($blogPostList['BlogLongDescription']) ? 'class="portfolioFancybox" href="blog/' . $blogPostList['BlogID'] . '"' : 'href="javascript:void(0);"') . '>' . strip_tags($blogPostList['BlogTitle']) . '</a>
                                            </h3>
                                            <div class="post-info">
                                                <p>' . strip_tags($blogPostList['BlogShortDescription']) . '</p>
                                            </div>
                                            <div class="post-info">
                                                <a>
                                                    <i class="icon icon-eye"></i>' . $blogPostList['Hint'] . '
                                                </a>
                                                <a>
                                                    <i class="icon icon-comments"></i>' . $commentCountQuery['count(1)'] . '
                                                </a>
                                            </div>
                                            ' . (($blogPostList['BlogLongDescription']) ? '<div class="post-tag"><a class="portfolioFancybox" href="blog/' . $blogPostList['BlogID'] . '">Read More</a></div>' : '') . '
                                         </div>';
                                    echo '
                                    </article>';
                                    if ($blogPostList['BlogLongDescription']) {
                                        echo '<div id="blog-detay' . $blogPostList['BlogID'] . '" class="fancybox-inline-box">
                                        ';
                                        if ($haveImage == 1)
                                            echo '<div class="inline-embed" data-embed-type="image" data-embed-url="assets/images/blog/b' . $blogPostList['BlogID'] . '.jpg"></div>';

                                        echo '
                                        <div class="inline-cont">
                                            <h2 class="inline-title">' . $blogPostList['BlogTitle'] . '</h2>
                                            <div class="inline-text">
                                                <p>' . $blogPostList['BlogLongDescription'] . '</p>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($SiteSetting['Message'] == 1) { ?>
                <section id="contact" class="section section-contact">
                    <div class="animate-up">
                        <h2 class="section-title">Contact me</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="section-box contact-form">
                                    <h3><?= $GeneralInformation['NameSurname'] ?></h3>

                                    <form class="rsForm" onsubmit="return false;" method="post">
                                        <div class="input-field">
                                            <label>Name Surname</label>
                                            <input type="text" name="sname" value="">
                                            <span class="line"></span>
                                        </div>

                                        <div class="input-field">
                                            <label>E-Mail</label>
                                            <input type="email" name="semail" value="">
                                            <span class="line"></span>
                                        </div>

                                        <div class="input-field">
                                            <label>Phone</label>
                                            <input type="text" name="stelephone" value="">
                                            <span class="line"></span>
                                        </div>

                                        <div class="input-field">
                                            <label>Message</label>
                                            <textarea rows="4" name="smessage"></textarea>
                                            <span class="line"></span>
                                        </div>

                                        <span class="btn-outer btn-primary-outer ripple">
                                        <input onclick="messagegonder();" class="rsFormSubmit btn btn-lg btn-primary"
                                               type="submit" value="Send">
                                    </span>
                                    </form>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="section-box contact-info has-map">
                                    <ul class="contact-list">
                                        <li class="clearfix">
                                            <strong>Address</strong>
                                            <span><?= $GeneralInformation['Address'] ?></span>
                                        </li>
                                        <li class="clearfix">
                                            <strong>Phone</strong>
                                            <span><a href="tel:<?= str_replace(' ', '', $GeneralInformation['Phone']) ?>"><?= $GeneralInformation['Phone'] ?></a></span>
                                        </li>
                                        <li class="clearfix">
                                            <strong>E-Mail</strong>
                                            <span><a href="mailto:<?= $GeneralInformation['EMail'] ?>"><?= $GeneralInformation['EMail'] ?></a></span>
                                        </li>
                                    </ul>
                                    <?php
                                    $explode = explode(',', $GeneralInformation['GoogleMap']);
                                    ?>
                                    <div id="map" data-latitude="<?= $explode[0] ?>"
                                         data-longitude="<?= $explode[1] ?>"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
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
<?php saveReferer(); ?>
</body>
</html>
