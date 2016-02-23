<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Forgot Password</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="<?php echo base_url()."home/forgot_password/"; ?>">Login</a>
            </div>
        </div>
        <div style="padding-top:30px" class="panel-body">
            <?php getMessage(); ?>
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <form id="forgotPasswordForm" class="form-horizontal" role="form" action="" method="post">
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="email" type="text" class="form-control" name="email" value="<?php echo !empty($_POST['email'])?$_POST['email']:""; ?>" placeholder="Email"/>
                    <?php echo getFormError("email"); ?>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <input type="submit" class="btn btn-success" value="Submit"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                            Don't have an account!
                            <a href="<?php echo base_url(); ?>home/signup/">Sign Up Here</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>