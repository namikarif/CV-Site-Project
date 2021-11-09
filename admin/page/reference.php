<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Reference</h3>
    </div>
    <form id="referenceForm" method="post">
    <div class="box-body">
        <div class="col-md-3" style="padding:0px;">
            <div class="form-group">
                <label>Select Reference Image</label>
                <input name="referenceImage" type="file" required="" />
            </div>
        </div>
        <div class="col-md-4" style="padding:0px 0px 0px 10px;">
            <div class="form-group">
                <label>Reference Name</label>
                <input class="form-control" name="referenceName" type="text" placeholder="Reference Name" required="">
            </div>
        </div>
        <div class="col-md-5" style="padding:0px 0px 0px 10px;">
            <div class="form-group">
                <label>Reference URL</label>
                <input class="form-control" name="referenceUrl" type="text" placeholder="Reference URL">
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button id="referenceButton" type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
    </div>
    </form>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user-md"></i> References</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td><b>Picture</b></td>
                    <td><b>Reference Name</b></td>
                    <td><b>URL</b></td>
                    <td><b>Process</b></td>
                </tr>
            </thead>
            <tbody id="referenceTable">
                <?php
                    $selectReference = mysqliQuery("SELECT * FROM `MY_REFERENCES` ORDER BY Date DESC");
                    if($selectReference->num_rows == 0)
                        echo '<tr><td>Reference not added</td><td></td><td></td><td></td></tr>';
                    else {
                        while($referenceList = $selectReference->fetch_array(MYSQLI_ASSOC))
                        {
                            echo '<tr id="referenceTableItem'.$referenceList['ReferenceID'].'">
                                    <td><a target="_blank" href="assets/images/reference/r'.$referenceList['ReferenceID'].'.jpg"><img width="100" src="assets/images/reference/r'.$referenceList['ReferenceID'].'.jpg" alt="'.$referenceList['ReferenceName'].'" class="img-responsive" /></td>
                                    <td>'.$referenceList['ReferenceName'].'</td>
                                    <td>'.$referenceList['URL'].'</td>
                                    <td><a onclick="deleteReference(\''.$referenceList['ReferenceID'].'\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                                  </tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>