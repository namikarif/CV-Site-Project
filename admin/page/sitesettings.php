<link rel="stylesheet" href="admin/plugins/iCheck/all.css">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-globe"></i> Settings</h3>
    </div>
    <form onsubmit="return false;" role="form">
        <div class="box-body">
            <div class="form-group col-md-6" style="padding:0px;">
                <label for="metadescription">Site Theme</label>
                <select class="form-control" name="theme">
                    <option value="light" <?= (($SiteSetting['Theme'] == 'light') ? 'selected="selected"' : '') ?>>
                        Light Color
                    </option>
                    <option value="dark" <?= (($SiteSetting['Theme'] == 'dark') ? 'selected="selected"' : '') ?>>
                        Dark Color
                    </option>
                </select>
            </div>
            <div class="form-group col-md-6" style="padding:0px 0px 0px 10px;">
                <label for="metadescription">Site Color</label>
                <select class="form-control" name="tcss">
                    <option value="amber#fec107" <?= (($SiteSetting['Css'] == 'amber') ? 'selected="selected"' : '') ?>>
                        Amber
                    </option>
                    <option value="blue#1a77d4" <?= (($SiteSetting['Css'] == 'blue') ? 'selected="selected"' : '') ?>>
                        Blue
                    </option>
                    <option value="coral#e8676b" <?= (($SiteSetting['Css'] == 'coral') ? 'selected="selected"' : '') ?>>
                        Coral
                    </option>
                    <option value="cyan#07aaf5" <?= (($SiteSetting['Css'] == 'cyan') ? 'selected="selected"' : '') ?>>
                        Cyan
                    </option>
                    <option value="green#07cb79" <?= (($SiteSetting['Css'] == 'green') ? 'selected="selected"' : '') ?>>
                        Green (Default)
                    </option>
                    <option value="indigo#5d6cc1" <?= (($SiteSetting['Css'] == 'indigo') ? 'selected="selected"' : '') ?>>
                        Indigo
                    </option>
                    <option value="lime#8dc24c" <?= (($SiteSetting['Css'] == 'lime') ? 'selected="selected"' : '') ?>>
                        Lime
                    </option>
                    <option value="orange#ff9801" <?= (($SiteSetting['Css'] == 'orange') ? 'selected="selected"' : '') ?>>
                        Orange
                    </option>
                    <option value="pink#ec407a" <?= (($SiteSetting['Css'] == 'pink') ? 'selected="selected"' : '') ?>>
                        Pink
                    </option>
                    <option value="purple#673bb7" <?= (($SiteSetting['Css'] == 'purple') ? 'selected="selected"' : '') ?>>
                        Purple
                    </option>
                    <option value="red#e83b35" <?= (($SiteSetting['Css'] == 'red') ? 'selected="selected"' : '') ?>>
                        Red
                    </option>
                    <option value="teal#27a79a" <?= (($SiteSetting['Css'] == 'teal') ? 'selected="selected"' : '') ?>>
                        Teal
                    </option>
                    <option value="royal-blue#3f51b5" <?= (($SiteSetting['Css'] == 'royal-blue') ? 'selected="selected"' : '') ?>>
                        Royal Blue
                    </option>
                    <option value="turquoise#56c8d2" <?= (($SiteSetting['Css'] == 'turquoise') ? 'selected="selected"' : '') ?>>
                        Turquoise
                    </option>
                    <option value="violet#8e45ae" <?= (($SiteSetting['Css'] == 'violet') ? 'selected="selected"' : '') ?>>
                        Violet
                    </option>
                    <option value="yellow#ffde03" <?= (($SiteSetting['Css'] == 'yellow') ? 'selected="selected"' : '') ?>>
                        Yellow
                    </option>
                    <option value="pale-coral#ffcfd3" <?= (($SiteSetting['Css'] == 'pale-coral') ? 'selected="selected"' : '') ?>>
                        Pale Coral
                    </option>
                    <option value="pale-cyan#83d5fb" <?= (($SiteSetting['Css'] == 'pale-cyan') ? 'selected="selected"' : '') ?>>
                        Pale Cyan
                    </option>
                    <option value="pale-green#a7d9a8" <?= (($SiteSetting['Css'] == 'pale-green') ? 'selected="selected"' : '') ?>>
                        Pale Green
                    </option>
                    <option value="pale-pink#fbbdd4" <?= (($SiteSetting['Css'] == 'pale-pink') ? 'selected="selected"' : '') ?>>
                        Pale Pink
                    </option>
                    <option value="pale-purple#c7ccea" <?= (($SiteSetting['Css'] == 'pale-purple') ? 'selected="selected"' : '') ?>>
                        Pale Purple
                    </option>
                    <option value="pale-red#d1a3a6" <?= (($SiteSetting['Css'] == 'pale-red') ? 'selected="selected"' : '') ?>>
                        Pale Red
                    </option>
                    <option value="pale-violet#e2bfe7" <?= (($SiteSetting['Css'] == 'pale-violet') ? 'selected="selected"' : '') ?>>
                        Pale Violet
                    </option>
                    <option value="dark-red#782f40" <?= (($SiteSetting['Css'] == 'dark-red') ? 'selected="selected"' : '') ?>>
                        Dark Red
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Site Title</label>
                <input id="title" value="<?= $SiteSetting['SiteTitle'] ?>" class="form-control" name="sitetitle"
                       type="text" placeholder="Site Title" required="">
            </div>
            <div class="form-group">
                <label for="metakeys">Meta Keys (Separate with commas )</label>
                <input id="metakeys" value="<?= $SiteSetting['MetaKeys'] ?>" class="form-control" name="metakeys"
                       type="text" placeholder="Meta Keys" required="">
            </div>
            <div class="form-group">
                <label for="metadescription">Meta Description</label>
                <input id="metadescription" value="<?= $SiteSetting['Description'] ?>" class="form-control"
                       name="metadescription" type="text" placeholder="Meta Description" required="">
            </div>
            <div class="checkbox">
                <label style="padding:0px;"><b>Fields to be Displayed on the Site:</b></label>
                <label>
                    <input class="minimal" value="1" <?= (($SiteSetting['AboutMe']) == 1 ? 'checked="checked"' : '') ?>
                           name="aboutMe" type="checkbox"/> About Me
                </label>
                <label>
                    <input class="minimal" value="1" <?= (($SiteSetting['Blog']) == 1 ? 'checked="checked"' : '') ?>
                           name="blog" type="checkbox"/> Blog
                </label>
                <label>
                    <input class="minimal" value="1" <?= (($SiteSetting['Awards']) == 1 ? 'checked="checked"' : '') ?>
                           name="awards" type="checkbox"/> Awards
                </label>
                <label>
                    <input class="minimal"
                           value="1" <?= (($SiteSetting['MyReferences']) == 1 ? 'checked="checked"' : '') ?>
                           name="references" type="checkbox"/> References
                </label>
                <label>
                    <input class="minimal"
                           value="1" <?= (($SiteSetting['Experiences']) == 1 ? 'checked="checked"' : '') ?>
                           name="experiences" type="checkbox"/> Experiences
                </label>
                <label>
                    <input class="minimal" value="1" <?= (($SiteSetting['Skills']) == 1 ? 'checked="checked"' : '') ?>
                           name="skill" type="checkbox"/> Skills
                </label>
                <label>
                    <input class="minimal" value="1" <?= (($SiteSetting['Projects']) == 1 ? 'checked="checked"' : '') ?>
                           name="projects" type="checkbox"/> Projects
                </label>
                <label>
                    <input class="minimal"
                           value="1" <?= (($SiteSetting['Educations']) == 1 ? 'checked="checked"' : '') ?>
                           name="educations" type="checkbox"/> Educations
                </label>
                <label>
                    <input class="minimal" value="1" <?= (($SiteSetting['Message']) == 1 ? 'checked="checked"' : '') ?>
                           name="message" type="checkbox"/> Message
                </label>
            </div>
        </div>
        <div class="box-footer">
            <button id="save" onclick="saveSiteSettings();" type="submit" class="btn btn-primary"><i
                        class="fa fa-check"></i> Save
            </button>
        </div>
    </form>
</div>
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
</script>
