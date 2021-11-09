<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Experience</h3>
    </div>
    <form onsubmit="return false;" id="experienceForm" role="form">
      <div class="box-body">
        <div class="col-md-6" style="padding:0px;">
            <div class="form-group">
                    <label>Company Name</label>
                    <input class="form-control" name="companyName" type="text" placeholder="Company Name" required="">
            </div>
        </div>
        <div class="col-md-6" style="padding:0px 0px 0px 10px;">
            <div class="form-group">
                <label>Position / Description</label>
                <input class="form-control" name="companyDescription" type="text" placeholder="Position or Description" required="">
            </div>
        </div>
        <div class="col-md-6" style="padding:0px;">
            <div class="form-group">
                <div class="col-md-6" style="padding-left:0px; padding-right:10px;">
                <label>Start Month</label>
                <select name="startMonth" class="form-control" required="">
                    <option value="">Select Month</option>
                    <?= months(); ?>
                </select>
                </div>
                <div class="col-md-6" style="padding-left:3px; padding-right:0px;">
                <label>Start Year</label>
                <select name="startYear" class="form-control"  required="">
                    <option value="">Select Year</option>
                    <?= years(); ?>
                </select>
                </div>
            </div>
        </div>
        <div class="col-md-6"  style="padding:0px 0px 0px 10px;">
            <div class="form-group">
                <div class="col-md-6" style="padding-left:0px; padding-right:10px;">
                <label>End Month</label>
                <select name="endMonth" class="form-control">
                    <option value="">Continues</option>
                    <?= months(); ?>
                </select>
                </div>
                <div class="col-md-6" style="padding-left:3px; padding-right:0px;">
                <label>End Year</label>
                <select name="endYear" class="form-control">
                    <option value="">Continues</option>
                    <?= years(); ?>
                </select>
                </div>
            </div>
        </div>
      </div>
      <div class="box-footer">
          <button id="save" onclick="addExperience();" type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
      </div>
    </form>
  </div>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-briefcase"></i> Experiences</h3>
    </div>
    <div class="box-body">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <td><b>Company Name</b></td>
                <td><b>Position / Description</b></td>
                <td><b>Start</b></td>
                <td><b>End</b></td>
                <td><b>Process</b></td>
            </tr>
        </thead>
        <tbody id="experienceTable">
            <?php
                $experience = mysqliQuery("SELECT * from EXPERIENCES order by StartYear DESC");
                if($experience->num_rows == 0)
                    echo '<tr><td>No experience added</td><td>No experience added</td><td>0000</td><td>0000</td><td></td></tr>';
                else {
                    while($experiences = $experience->fetch_array(MYSQLI_ASSOC))
                    {
                        echo '<tr id="experienceTableItem'.$experiences['ExperiencesID'].'">
                                <td>'.$experiences['CompanyName'].'</td>
                                <td>'.$experiences['CompanyDescription'].'</td>
                                <td>'.changeMonthToString($experiences['StartMonth']).' '.$experiences['StartYear'].'</td>
                                <td>'.(($experiences['EndMonth']) ? changeMonthToString($experiences['EndMonth']).' ' .$experiences['EndYear'] : 'Continues' ).'</td>
                                <td><a onclick="deleteExperience(\''.$experiences['ExperiencesID'].'\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                              </tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    </div>
</div>