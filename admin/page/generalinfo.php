<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-picture-o"></i> Images</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Change Profile Picture</label>
                        <img id="generalProfilePicture" class="profile-user-img img-responsive img-circle" src="../assets/images/profile.jpg" alt="User profile picture">
                        <form id="changeProfilePicture">
                            <input name="profileImage" type="file"/>
                            <button id="profilePictureButton" type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i>
                                Change Profile Picture
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Change Cover Picture</label>
                        <img id="coverPicture" class="cover-img img-responsive" src="../assets/images/cover.jpg" alt="User profile picture">
                        <form id="changeCoverPicture" method="post">
                            <input name="coverImage" type="file"/>
                            <button id="coverButton" type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i>
                                Change Cover Picture
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form onsubmit="return false;">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cogs"></i> General Info</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="headerText">Header Text</label>
                        <input id="headerText" value="<?= $GeneralInformation['HeaderText'] ?>" class="form-control"
                               name="headerText" type="text" placeholder="Header Text" required="">
                    </div>
                    <div class="form-group">
                        <label for="nameSurname">Name Surname</label>
                        <input id="nameSurname" value="<?= $GeneralInformation['NameSurname'] ?>" class="form-control"
                               name="nameSurname" type="text" placeholder="Name Surname" required="">
                    </div>
                    <div class="form-group">
                        <label for="ShortText">Short Text (Slogan)</label>
                        <input id="ShortText" value="<?= $GeneralInformation['ShortText'] ?>" class="form-control"
                               name="ShortText" type="text" placeholder="Short Text (Slogan)" required="">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Phone</label>
                        <input id="telephone" value="<?= $GeneralInformation['Phone'] ?>" class="form-control"
                               name="telephone" type="text" placeholder="Phone" required="">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input id="address" value="<?= $GeneralInformation['Address'] ?>" class="form-control"
                               name="address" type="text" placeholder="Address" required="">
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input id="email" value="<?= $GeneralInformation['EMail'] ?>" class="form-control" name="email"
                               type="email" placeholder="E-Mail" required="">
                    </div>
                    <div class="form-group">
                        <label for="birthDay">Birth Day</label>
                        <input id="birthDay" value="<?= $GeneralInformation['BirthDate'] ?>" class="form-control"
                               name="birthDay" type="text" placeholder="Birth Day" required="">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-share-alt"></i> Social Media</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="facebook"><i class="fa fa-facebook-official"></i> Facebook</label>
                        <input id="facebook" value="<?= $GeneralInformation['Facebook'] ?>" class="form-control"
                               name="facebook"
                               type="text"
                               placeholder="Without writing https://www.facebook.com type the information in the last section">
                    </div>
                    <div class="form-group">
                        <label for="twitter"><i class="fa fa-twitter"></i> Twitter</label>
                        <input id="twitter" value="<?= $GeneralInformation['Twitter'] ?>" class="form-control"
                               name="twitter"
                               type="text"
                               placeholder="Without writing https://www.twitter.com type the information in the last section">
                    </div>
                    <div class="form-group">
                        <label for="instagram"><i class="fa fa-instagram"></i> Instagram</label>
                        <input id="instagram" value="<?= $GeneralInformation['Instagram'] ?>" class="form-control"
                               name="instagram" type="text"
                               placeholder="hWithout writing https://www.instagram.com type the information in the last section">
                    </div>
                    <div class="form-group col-md-6" style="padding:0px;">
                        <label for="skype"><i class="fa fa-skype"></i> Skype</label>
                        <input id="skype" value="<?= $GeneralInformation['Skype'] ?>" class="form-control" name="skype"
                               type="text" placeholder="Skype address">
                    </div>
                    <div class="form-group col-md-6" style="padding:0px 0px 0px 10px;">
                        <label for="connectionType">Connection Type</label>
                        <select id="connectionType" name="connectionType" class="form-control">
                            <option value="">Select</option>
                            <option <?= (($GeneralInformation['SkypeConnectionType'] == 'chat') ? 'selected="selected"' : '') ?>
                                    value="chat">Chat
                            </option>
                            <option <?= (($GeneralInformation['SkypeConnectionType'] == 'call') ? 'selected="selected"' : '') ?>
                                    value="call">Call
                            </option>
                            <option <?= (($GeneralInformation['SkypeConnectionType'] == 'add') ? 'selected="selected"' : '') ?>
                                    value="add">Add
                            </option>
                            <option <?= (($GeneralInformation['SkypeConnectionType'] == 'userinfo') ? 'selected="selected"' : '') ?>
                                    value="userinfo">Contact Information
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fa fa-tumblr"></i> Tumblr</label>
                        <input id="email" value="<?= $GeneralInformation['Tumblr'] ?>" class="form-control"
                               name="tumblr"
                               type="text" placeholder="Tumblr username">
                    </div>
                    <div class="form-group">
                        <label for="youtube"><i class="fa fa-youtube"></i> Youtube</label>
                        <input id="youtube" value="<?= $GeneralInformation['Youtube'] ?>" class="form-control"
                               name="youtube"
                               type="text"
                               placeholder="Without writing https://www.youtube.com type the information in the last section">
                    </div>
                    <div class="form-group">
                        <label for="linkedin"><i class="fa fa-linkedin"></i> LinkedIn</label>
                        <input id="linkedin" value="<?= $GeneralInformation['Linkedin'] ?>" class="form-control"
                               name="linkedin"
                               type="text"
                               placeholder="Without writing https://www.linkedin.com type the information in the last section">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cog"></i> Other</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="googleMap">Google Map</label>
                        <input id="googleMap" value="<?= $GeneralInformation['GoogleMap'] ?>" class="form-control"
                               name="googleMap" type="text"
                               placeholder="Google Map Coordinate Code (Sample: 22.053693,35.891553)">
                    </div>
                    <div class="form-group">
                        <label for="aboutMe">About Me Text</label>
                        <textarea rows="7"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                  id="aboutMe" class="textarea" name="aboutMe" type="text"
                                  placeholder="About Me Text"><?= stripslashes($GeneralInformation['AboutMe']) ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button id="save" onclick="saveGeneralSetting();" type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-check"></i> Save
                    </button>
                </div>
            </div>
        </div>
</div>
</form>