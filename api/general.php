<?php
require "core/function.php";
$functions = new FunctionClass();

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    $_code = 200;
    $json['data'] = 'OPTIONS';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $selectSiteSettingsQuery = $mysqli->query("SELECT * FROM SITE_SETTINGS");
        $selectGeneralInformationQuery = $mysqli->query("SELECT * FROM GENERAL_INFORMATION");
        $selectContinuingEducationQuery = $mysqli->query("SELECT SchoolName, Department FROM EDUCATIONS WHERE GraduatedYear = '' or GraduatedYear is null order by GraduatedYear DESC");
        $selectCompletedEducationQuery = $mysqli->query("SELECT SchoolName, Department FROM EDUCATIONS WHERE GraduatedYear = '' or GraduatedYear is null order by GraduatedYear DESC");
        $selectSkillQuery = $mysqli->query("SELECT SkillDescription, Percent FROM SKILL ORDER BY Percent DESC");
        $selectExperienceQuery = $mysqli->query("SELECT * FROM EXPERIENCES ORDER BY StartYear DESC, StartMonth DESC");
        $selectAwardQuery = $mysqli->query("SELECT AwardDescription, AwardYear FROM AWARDS ORDER BY AwardYear DESC");
        $selectProjectCategoriesQuery = $mysqli->query("SELECT * FROM PROJECT_CATEGORIES order by CategoryName ASC");
        $selectProjectsQuery = $mysqli->query("SELECT ProjectID, ProjectName, ShortDescription, LongDescription FROM PROJECTS ORDER BY ProjectID DESC");
        $selectMyReferersQuery = $mysqli->query("SELECT ReferenceID, URL, ReferenceName FROM MY_REFERENCES ORDER BY Date DESC");
        $selectBlogQuery = $mysqli->query("SELECT MY_BLOG.*,(SELECT group_concat(CONCAT('{\"CommentDate\": \"',COALESCE(BLOG_COMMENT.CommentDate, ''), '\", \"Name\" : \"', COALESCE(BLOG_COMMENT.Name, ''), '\", \"Comment\" : \"', COALESCE(BLOG_COMMENT.Comment, ''),'\", \"Email\" : \"', COALESCE(BLOG_COMMENT.Email, ''),'\", \"WebSite\" : \"', COALESCE(BLOG_COMMENT.WebSite, ''),'\"}')) FROM BLOG_COMMENT WHERE BLOG_COMMENT.BlogID = MY_BLOG.BlogID AND BLOG_COMMENT.Status = 1) AS COMMENTS FROM MY_BLOG WHERE Active = 1 ORDER BY Date DESC");
        if ($selectSiteSettingsQuery) {
            $_code = 201;
            $json['siteSettings'] = $selectSiteSettingsQuery->fetch_array(MYSQLI_ASSOC);
            $json['generalInformation'] = $selectGeneralInformationQuery->fetch_array(MYSQLI_ASSOC);
            $json['continuingEducations'] = $selectContinuingEducationQuery->fetch_all(MYSQLI_ASSOC);
            $json['completedEducations'] = $selectCompletedEducationQuery->fetch_all(MYSQLI_ASSOC);
            $json['skills'] = $selectSkillQuery->fetch_all(MYSQLI_ASSOC);
            $json['experiences'] = $selectExperienceQuery->fetch_all(MYSQLI_ASSOC);
            $json['awards'] = $selectAwardQuery->fetch_all(MYSQLI_ASSOC);
            $json['projects'] = $selectProjectsQuery->fetch_all(MYSQLI_ASSOC);
            $json['projectCategories'] = $selectProjectCategoriesQuery->fetch_all(MYSQLI_ASSOC);
            $json['myReferences'] = $selectMyReferersQuery->fetch_all(MYSQLI_ASSOC);
            $json['blogs'] = $selectBlogQuery->fetch_all(MYSQLI_ASSOC);

            $blogCount = count($json['blogs']);

            for ($i = 0; $i < $blogCount; $i++) {
                $json['blogs'][$i]['COMMENTS'] = json_decode('[' .  $json['blogs'][$i]['COMMENTS'] . ']');
            }
        } else {
            $_code = 400;
            $json = $functions->handleError($mysqli->error);
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
