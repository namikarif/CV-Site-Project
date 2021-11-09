<?php
$blogDetail = mysqliQuery("SELECT * from BLOG_COMMENT where BlogID='" . firewall($_GET['data']) . "'");
if ($blogDetail->num_rows == 0) {
    echo '<p>Comment not found.</p>';
} else {
    ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i> Post Comments</h3>
        </div>
        <ul class="timeline">
            <?php while ($row = $blogDetail->fetch_array(MYSQLI_ASSOC)) { ?>
                <li id="commentTable<?= $row['ID'] ?>">
                    <div class="timeline-item">
                        <span class="time"> <?php echo ActiveDate(date($row['CommentDate'])) ?></span>

                        <h3 class="timeline-header"><a><?= $row['Name'] ?></a> commented on your post</h3>

                        <div class="timeline-body">
                            <?= $row['Comment'] ?>
                        </div>
                        <div class="timeline-footer" id="commentTableButton<?= $row['ID'] ?>">
                            <?php if ($row['Status'] === 1) { ?>
                                <a class="btn btn-info btn-xs" id="deactivateButton<?= $row['ID'] ?>" onclick="doDeactivateComment(<?= $row['ID'] ?>)">Deactivate comment</a>
                            <?php } else { ?>
                                <a class="btn btn-success btn-xs" id="activeButton<?= $row['ID'] ?>" onclick="doActiveComment(<?= $row['ID'] ?>)">Activate comment</a>
                            <?php } ?>
                            <a class="btn btn-danger btn-xs" onclick="deleteComment(<?= $row['ID'] ?>)">Delete
                                comment</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>