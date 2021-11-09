<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Project Category</h3>
    </div>
    <form onsubmit="return false;" id="categoryForm">
        <div class="box-body">
            <div class="form-group">
                <label>Category Name</label>
                <input class="form-control" name="categoryName" type="text" placeholder="Category Name" required="">
            </div>
        </div>
        <div class="box-footer">
            <button id="save" onclick="addCategory();" type="submit" class="btn btn-primary"><i
                        class="fa fa-plus-circle"></i> Add
            </button>
        </div>
    </form>
</div>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list"></i> Project Category</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td class="col-md-10"><b>Category Name</b></td>
                <td class="col-md-2"><b>Process</b></td>
            </tr>
            </thead>
            <tbody id="categoryTable">
            <?php
            $selectCategories = mysqliQuery("SELECT * from PROJECT_CATEGORIES order by CategoryName ASC");
            if ($selectCategories->num_rows == 0)
                echo '<tr><td>Category not added</td><td></td></tr>';
            else {
                while ($categoryList = $selectCategories->fetch_array(MYSQLI_ASSOC)) {
                    echo '<tr id="categoryTableItem' . $categoryList['CategoryID'] . '">
                                <td>' . $categoryList['CategoryName'] . '</td>
                                <td><a onclick="deleteCategory(\'' . $categoryList['CategoryID'] . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                              </tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Project</h3>
    </div>
    <form id="projectForm" method="post">
        <div class="box-body">
            <div class="col-md-6" style="padding:0px;">
                <div class="form-group">
                    <label>Select Project Image</label>
                    <input name="projectImage" type="file" required=""/>
                </div>
            </div>
            <div class="col-md-6" style="padding:0px 0px 0px 10px;">
                <div class="form-group">
                    <label>Category</label>
                    <select id="selectCategory" name="projectCategory" class="form-control" required="">
                        <option value="">Select</option>
                        <?php
                        projectCategories();
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12" style="padding:0px;">
                <div class="form-group">
                    <label>Project Title</label>
                    <input class="form-control" name="projectTitle" type="text" placeholder="Project Title" required="">
                    <label>Short Description</label>
                    <input class="form-control" name="shortText" type="text" placeholder="Short Description"
                           required="">
                    <label>Long Description</label>
                    <textarea name="longText" placeholder="Long Description" class="form-control" rows="7"
                              required=""></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button id="projectButton" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
        </div>
    </form>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list-ul"></i> Projects</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td><b>Image</b></td>
                <td><b>Category</b></td>
                <td><b>Title</b></td>
                <td><b>Short Description</b></td>
                <td><b>Long Description</b></td>
                <td><b>Process</b></td>
            </tr>
            </thead>
            <tbody id="projectTable">
            <?php
            $selectProjects = mysqliQuery("SELECT P.ProjectID, P.ProjectName, P.ShortDescription, P.LongDescription, K.CategoryName from PROJECTS P inner join PROJECT_CATEGORIES K on K.CategoryID = P.CategoryID order by P.ProjectID DESC");
            if ($selectProjects->num_rows == 0)
                echo '<tr><td>Project not added</td><td></td><td></td><td></td><td></td><td></td></tr>';
            else {
                while ($projectList = $selectProjects->fetch_array(MYSQLI_ASSOC)) {
                    echo '<tr id="projectTableItem' . $projectList['ProjectID'] . '">
                                    <td><a target="_blank" href="assets/images/projects/p' . $projectList['ProjectID'] . '.jpg"><img width="100" src="assets/images/projects/p' . $projectList['ProjectID'] . '.jpg" alt="' . $projectList['ProjectName'] . '" class="img-responsive" /></td>
                                    <td>' . $projectList['CategoryName'] . '</td>
                                    <td>' . $projectList['ProjectName'] . '</td>
                                    <td>' . $projectList['ShortDescription'] . '</td>
                                    <td>' . $projectList['LongDescription'] . '</td>
                                    <td><a onclick="deleteProject(\'' . $projectList['ProjectID'] . '\');" class="btn btn-block btn-danger"><i class="fa fa-times"></i> Delete</a></td>
                                  </tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>