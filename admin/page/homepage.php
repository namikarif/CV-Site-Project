<div class="row">
    <div class="col-lg-4">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>Settings</h3>
                <p>Password, settings</p>
            </div>
            <div class="icon">
                <i class="fa fa-globe"></i>
            </div>
            <a href="admin/sitesettings" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="small-box bg-green-gradient">
            <div class="inner">
                <h3>General Info</h3>
                <p>Personal info, picture</p>
            </div>
            <div class="icon">
                <i class="fa fa-cogs"></i>
            </div>
            <a href="admin/generalinfo" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="small-box bg-fuchsia">
            <div class="inner">
                <h3>Blog</h3>
                <p>Post, Article</p>
            </div>
            <div class="icon">
                <i class="fa fa-pencil-square-o"></i>
            </div>
            <a href="admin/blog" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="small-box bg-aqua-gradient">
            <div class="inner">
                <h3>Educations</h3>
                <p>University, Course</p>
            </div>
            <div class="icon">
                <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="admin/education" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-light-blue-gradient">
            <div class="inner">
                <h3>Experiences</h3>
                <p>Works, projects</p>
            </div>
            <div class="icon">
                <i class="fa fa-briefcase"></i>
            </div>
            <a href="admin/experience" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-blue-gradient">
            <div class="inner">
                <h3>Skills</h3>
                <p>Knowledge, Skill</p>
            </div>
            <div class="icon">
                <i class="fa fa-child"></i>
            </div>
            <a href="admin/skill" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-facebook">
            <div class="inner">
                <h3>Projects</h3>
                <p>Your projects</p>
            </div>
            <div class="icon">
                <i class="fa fa-list-ul"></i>
            </div>
            <a href="admin/projects" class="small-box-footer">Go to Page <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="small-box bg-yellow-gradient">
            <div class="inner">
                <h3>Awards</h3>
                <p>Certificate, document</p>
            </div>
            <div class="icon">
                <i class="fa fa-trophy"></i>
            </div>
            <a href="admin/award" class="small-box-footer">Go to Page
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>References</h3>
                <p>Institution, person</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-md"></i>
            </div>
            <a href="admin/reference" class="small-box-footer">Go to Page
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-red-gradient">
            <div class="inner">
                <h3>Messages</h3>
                <div class="alt-title"><?php $messageQuery = query('count(1)', 'INBOX', "Status = 1"); echo $messageQuery['count(1)'] > 0 ? '
                    <div class="badgest-container">
                        <div class="badgest">
                            <span class="number">' . $messageQuery['count(1)'] . '</span>
                        </div>
                    </div>' : '' ?>
                    <span class="<?= $messageQuery['count(1)'] > 0 ? 'mrg' : '' ?>">Inbox</span>
                </div>
            </div>
            <div class="icon">
                <i class="fa fa-envelope-o"></i>
            </div>
            <a href="admin/message" class="small-box-footer">Go to Page
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-maroon-gradient">
            <div class="inner">
                <h3>Referers</h3>
                <div class="alt-title">
                    <?php $refererQuery = query('count(1)', 'SITE_LOGS', "RefererURL <> 'Indefinite / Direct' and Status = 1");echo $refererQuery['count(1)'] > 0 ? '<div class="badgest-container">
                        <div class="badgest">
                            <span class="number">' . $refererQuery['count(1)'] . '</span>
                        </div>
                    </div>' : '' ?>
                    <span class="<?= $refererQuery['count(1)'] > 0 ? 'mrg' : '' ?>">Referer URL</span>
                </div>
            </div>
            <div class="icon">
                <i class="fa fa-external-link"></i>
            </div>
            <a href="admin/referer/1" class="small-box-footer">Go to Page
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
