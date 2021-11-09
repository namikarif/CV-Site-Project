<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Skill</h3>
    </div>
    <form onsubmit="return false;" id="skillForm">
    <div class="box-body">
        <div class="col-md-9" style="padding:0px;">
            <div class="form-group">
                <label>Skill Name</label>
                <input class="form-control" name="skillDescription" type="text" placeholder="Skill Name" required="">
            </div>
        </div>
        <div class="col-md-3" style="padding:0px 0px 0px 10px;">
            <div class="form-group">
                <label>Percent</label>
                <select name="percent" class="form-control" required="">
                    <option value="">Select</option>
                    <?= percent(); ?>
                </select>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button id="save" onclick="addSkill();" type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
    </div>
    </form>
</div>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-pencil"></i> Skills</h3>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <td class="col-md-8"><b>Skill Name</b></td>
                <td class="col-md-2"><b>Percent</b></td>
                <td class="col-md-2"><b>Process</b></td>
            </tr>
        </thead>
        <tbody id="skillTable">
            <?php
                $selectSkills = mysqliQuery("SELECT * from SKILL order by Percent DESC");
                if($selectSkills->num_rows == 0)
                    echo '<tr><td>Skill not added</td><td>0</td><td></td></tr>';
                else {
                    while($skillList = $selectSkills->fetch_array(MYSQLI_ASSOC))
                    {
                        echo '<tr id="skillTableItem'.$skillList['SkillID'].'">
                                <td>'.$skillList['SkillDescription'].'</td>
                                <td>'.$skillList['Percent'].'</td>
                                <td><a onclick="deleteSkill(\''.$skillList['SkillID'].'\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                              </tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    </div>
</div>