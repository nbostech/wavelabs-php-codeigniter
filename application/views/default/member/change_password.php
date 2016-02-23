<div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Change Password</div>
        </div>
        <div style="padding-top:30px" class="panel-body">
            <?php getMessage(); ?>
            <form id="changePwdForm" class="form-horizontal" role="form" action="" method="post">
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Old Password">
                    <?php echo getFormError("password"); ?>
                </div>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="newPassword" type="password" class="form-control" name="newPassword" placeholder="New Password">
                    <?php echo getFormError("newPassword"); ?>
                </div>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="newPasswordCnf" type="password" class="form-control" name="newPasswordCnf" placeholder="New Password Confirm">
                    <?php echo getFormError("newPasswordCnf"); ?>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <input type="submit" class="btn btn-success" value="Change Password"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>