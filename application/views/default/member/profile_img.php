<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Profile Image</div>
        </div>
        <div class="panel-body">
            <form id="signupform" class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $member->id; ?>" />
                <input type="hidden" name="mediafor" value="profile" />
                <?php if(!empty($profile_img)){ ?>
                <div class="form-group">
                    <img src="<?php echo $profile_img; ?>" />
                </div>
                <?php } ?>
                <div class="form-group">
                    <label for="firstname" class="col-md-3 control-label">Media</label>

                    <div class="col-md-9">
                        <input type="file" class="form-control" name="file" value=""/>
                        <?php echo getFormError("file"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>
                            &nbsp Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>