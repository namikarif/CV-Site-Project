<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Award</h3>
    </div>
    <form onsubmit="return false;" id="awardForm" role="form">
      <div class="box-body">
        <div class="form-group col-md-10" style="padding:0px;">
          <label for="awardDescription">Award Name</label>
            <input id="awardDescription" class="form-control" name="awardDescription" type="text" placeholder="Award Name" required="">
        </div>
        <div class="form-group col-md-2" style="padding:0px 0px 0px 10px;">
          <label for="awardYear">Year</label>
            <select name="awardYear" class="form-control" required="">
                <option value="">Select</option>
                <?= years(); ?>
            </select>
        </div>
      </div>
      <div class="box-footer">
          <button id="save" onclick="addAward();" type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
      </div>
    </form>
  </div>
<div class="box box-info">
<div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-trophy"></i> Awards</h3>
</div>
<div class="box-body">
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <td class="col-md-8"><b>Award Name</b></td>
            <td class="col-md-2"><b>Year</b></td>
            <td class="col-md-2"><b>Process</b></td>
        </tr>
    </thead>
    <tbody id="awardTable">
        <?php
            $selectAwards = mysqliQuery("SELECT * from AWARDS order by AwardYear DESC");
            if($selectAwards->num_rows == 0)
                echo '<tr><td>Award not added</td><td>0000</td><td></td></tr>';
            else {
                while($awardList = $selectAwards->fetch_array(MYSQLI_ASSOC))
                {
                    echo '<tr id="awardTableItem'.$awardList['AwardID'].'">
                            <td>'.$awardList['AwardDescription'].'</td>
                            <td>'.$awardList['AwardYear'].'</td>
                            <td><a onclick="deleteAward(\''.$awardList['AwardID'].'\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                          </tr>';
                }
            }
        ?>
    </tbody>
</table>
</div>
</div>