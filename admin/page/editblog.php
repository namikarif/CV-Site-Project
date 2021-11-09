<?php
$blogDetail = mysqliQuery("SELECT * from MY_BLOG where BlogID='" . firewall($_GET['data']) . "'");
if ($blogDetail->num_rows == 0) {
    echo '<p>Post not found.</p> ';
} else {
    $blogDetail = $blogDetail->fetch_array(MYSQLI_ASSOC);
    ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i> Edit Post</h3>
        </div>
        <form onsubmit="return false;" method="post">
            <div class="box-body">
                <div class="col-md-12" style="padding:0px;">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="title" type="text" placeholder="Title"
                               value="<?= $blogDetail['BlogTitle'] ?>" required="">
                        <input class="form-control" name="id" type="hidden" value="<?= firewall($_GET['data']) ?>"
                               required="">
                    </div>
                </div>
                <div class="col-md-12" style="padding:0px;">
                    <div class="form-group">
                        <label>Short description</label>
                        <textarea
                                style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                id="ShortText" class="textarea" name="shortText" type="text"
                                placeholder="Short article that will appear in my blog section"><?= stripslashes($blogDetail['BlogShortDescription']) ?></textarea>
                    </div>
                </div>
                <div class="col-md-12" style="padding:0px;">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                id="longText" class="textarea" name="longText" type="text"
                                placeholder="Enter the long text that will appear when you click the Read more button. If left blank, read more button will not appear."><?= stripslashes($blogDetail['BlogLongDescription']) ?></textarea>
                    </div>
                </div>
                <div class="col-md-12" style="padding:0px;">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option <?= (($blogDetail['Active'] == 1) ? 'selected="selected"' : '') ?> value="1">
                                Active
                            </option>
                            <option <?= (($blogDetail['Active'] == 0) ? 'selected="selected"' : '') ?> value="0">
                                Passive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12" style="padding:0px;">
                    <div class="form-group">
                        <label>Post Tags</label>
                        <input class="form-control" name="metaKeys" type="text" placeholder="Post Tags"
                               value="<?= $blogDetail['MetaKeys'] ?>">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button id="editBlog" onclick="editBlogFunction()" type="submit" class="btn btn-primary">
                    <i class="fa fa-pencil-square"></i> Edit Post
                </button>
            </div>
        </form>
    </div>
<?php } ?>