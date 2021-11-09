<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Add Post</h3>
    </div>
    <form id="blogForm">
        <div class="box-body">
            <div class="col-md-12" style="padding:0px;">
                <div class="form-group">
                    <label>Select Picture</label>
                    <input name="blogImage" accept="image/*" type="file"/>
                </div>
            </div>
            <div class="col-md-12" style="padding:0px;">
                <div class="form-group">
                    <label>Blog Title</label>
                    <input class="form-control" name="title" type="text" placeholder="Blog Title" required="">
                </div>
            </div>
            <div class="col-md-12" style="padding:0px;">
                <div class="form-group">
                    <label>Short Description</label>
                    <textarea
                        style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                        id="ShortText" class="textarea" name="ShortText" type="text"
                        placeholder="Short article that will appear in my blog section"></textarea>
                </div>
            </div>
            <div class="col-md-12" style="padding:0px;">
                <div class="form-group">
                    <label>Content</label>
                    <textarea
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                        id="longText" class="textarea" name="longText" type="text"
                        placeholder="Enter the long text that will appear when you click the Read more button. If left blank, read more button will not appear."></textarea>
                </div>
            </div>
            <div class="col-md-12" style="padding:0px;">
                <div class="form-group">
                    <label>Post Tags</label>
                    <input class="form-control" name="metaKeys" type="text" placeholder="Post Tags">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button id="blogButton" type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>
        </div>
    </form>
</div>