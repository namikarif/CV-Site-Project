<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Education</h3>
    </div>
    <form onsubmit="return false;" id="educationForm">
        <div class="box-body">
            <div class="col-md-4" style="padding:0px;">
                <div class="form-group">
                    <label>Education / School Name</label>
                    <input class="form-control" name="schoolName" type="text" placeholder="Education / School Name"
                           required="">
                </div>
            </div>
            <div class="col-md-4" style="padding:0px 0px 0px 10px;">
                <div class="form-group">
                    <label>Department</label>
                    <input class="form-control" name="department" type="text" placeholder="Department">
                </div>
            </div>
            <div class="col-md-4" style="padding:0px 0px 0px 10px;">
                <div class="form-group">
                    <label>Graduate Year</label>
                    <select name="graduatedYear" class="form-control">
                        <option value="">Continues</option>
                        <?= years(); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button id="save" onclick="addEducation();" type="submit" class="btn btn-primary"><i
                        class="fa fa-plus-circle"></i> Add Education
            </button>
        </div>
    </form>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-graduation-cap"></i> Educations</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td><b>Education / School Name</b></td>
                <td><b>Department</b></td>
                <td><b>Graduate Year</b></td>
                <td><b>Process</b></td>
            </tr>
            </thead>
            <tbody id="educationTable">
            <?php
            $selectEducation = mysqliQuery("SELECT * from EDUCATIONS order by GraduatedYear DESC");
            if ($selectEducation->num_rows == 0)
                echo '<tr><td>Education has not been added</td><td></td><td>0000</td><td></td></tr>';
            else {
                while ($education = $selectEducation->fetch_array(MYSQLI_ASSOC)) {
                    echo '<tr id="educationTableItem' . $education['EducationID'] . '">
                                <td>' . $education['SchoolName'] . '</td>
                                <td>' . $education['Department'] . '</td>
                                <td>' . (($education['GraduatedYear']) ? $education['GraduatedYear'] : 'Continues') . '</td>
                                <td><a onclick="deleteEducation(\'' . $education['EducationID'] . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                              </tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>