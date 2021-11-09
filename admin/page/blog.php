<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> My Blog</h3>
        <a href="admin/addblog" type="button" class="btn btn-sm btn-success" style="float: right;"><i class="fa fa-add"></i> Add POST</a>
        <button type="button" style="display: none !important;" id="xmlURLModalButton" data-toggle="modal"
                data-target="#xmlURLModal">
            Launch demo modal
        </button>
        <button class="btn btn-sm btn-info" style="float: right;" onclick="createBlogXML()">Create Sitemap XML</button>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td><b>Picture</b></td>
                <td><b>Title</b></td>
                <td><b>Sort Desc</b></td>
                <td><b>Long Desc</b></td>
                <td><b>Tags</b></td>
                <td><b>Process</b></td>
            </tr>
            </thead>
            <tbody id="blogTable">
            <?php
            $myBlog = mysqliQuery("SELECT * from MY_BLOG order by Date DESC");
            if ($myBlog->num_rows == 0)
                echo '<tr><td>No post added</td><td></td><td></td><td></td><td></td><td></td></tr>';
            else {
                while ($blogPost = $myBlog->fetch_array(MYSQLI_ASSOC)) {
                    $countComment = query('count(*)', 'BLOG_COMMENT', 'BlogID = ' . $blogPost['BlogID']);
                    echo '<tr id="blogTableItem' . $blogPost['BlogID'] . '">
                                    <td><a target="_blank" href="assets/images/blog/b' . $blogPost['BlogID'] . '.jpg"><img style="height: 110px; margin: auto;" src="assets/images/blog/b' . $blogPost['BlogID'] . '.jpg" alt="' . $blogPost['BlogTitle'] . '" class="img-responsive" /></td>
                                    <td>' . (($blogPost['Active'] == 1) ? '<i class="fa fa-circle text-success" title="Publication"></i>' : '<i class="fa fa-circle text-danger" title="Not Publication"></i>') . ' ' . $blogPost['BlogTitle'] . '</td>
                                    <td>' . strip_tags(stripslashes($blogPost['BlogShortDescription'])) . '</td>
                                    <td><span class="blog-content">' . strip_tags(stripslashes($blogPost['BlogLongDescription'])) . '</span></td>
                                    <td>' . $blogPost['MetaKeys'] . '</td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="moveToTop(' . $blogPost['BlogID'] . ')" class="btn btn-success btn-block align-left"><i class="fa fa-arrow-up"></i> Move to Top</a>
                                        <a href="admin/editblog/' . $blogPost['BlogID'] . '" class="btn btn-primary btn-block align-left"><i class="fa fa-pencil"></i> Edit</a>';
                                    if ($countComment['count(*)'] > 0) {
                                        echo '<a href="admin/blogcomment/' . $blogPost['BlogID'] . '" class="btn btn-primary btn-block align-left"><i class="fa fa-comment-o"></i> Comments (' . $countComment['count(*)'] . ')</a>';
                                    }
                                    echo '<a onclick="deleteBlog(\'' . $blogPost['BlogID'] . '\');" class="btn btn-danger btn-block align-left"><i class="fa fa-times"></i> Delete</a>
                                    </td>
                                  </tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="xmlURLModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">XML URL</h4>
            </div>
            <div class="modal-body">
                <span>Click and copy URL</span>
                <p id="c1"></p>
                <input type="text" class="form-control form-control-sm" id="xmlURLInput"
                       value="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; ?>/blogpost.xml">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#xmlURLInput').bind('keypress', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $('#xmlURLInput').bind('click', () => {
        $('#c1').text("");
        const copy = copyToClipboard(document.getElementById("xmlURLInput"));
        if (copy) {
            $('#c1').text("XML Url copied");
            $('#c1').css("color", "green");
        } else {
            $('#c1').text("XML Url not copied");
            $('#c1').css("color", "red");
        }
    });

    function copyToClipboard(elem) {
        const targetId = "_hiddenCopyText_";
        const isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        let origSelectionStart, origSelectionEnd;
        if (isInput) {
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            target = document.getElementById(targetId);
            if (!target) {
                const target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        const currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        let succeed;
        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            succeed = false;
        }
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            target.textContent = "";
        }
        return succeed;
    }
</script>