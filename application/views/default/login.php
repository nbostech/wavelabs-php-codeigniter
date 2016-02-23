<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Login</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="<?php echo base_url()."home/forgot_password/"; ?>">Forgot password?</a>
            </div>
        </div>
        <div style="padding-top:30px" class="panel-body">
            <?php getMessage(); ?>
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <form id="loginform" class="form-horizontal" role="form" action="" method="post">
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="username" value="<?php echo !empty($_POST['username'])?$_POST['username']:""; ?>" placeholder="username or email"/>
                    <?php echo getFormError("username"); ?>
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    <?php echo getFormError("password"); ?>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <input type="submit" class="btn btn-success" value="Login"/>
                    </div>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <a href="<?php echo base_url(); ?>social/facebook/connect/" class="btn btn-primary">Login with Facebook</a>
                        <a href="<?php echo base_url(); ?>social/google/connect/" class="btn btn-danger">Login with Google</a>
                        <a href="<?php echo base_url(); ?>social/twitter/connect/" class="btn btn-info">Login with Twitter</a>
                    </div>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <a href="<?php echo base_url(); ?>social/instagram/connect/" class="btn btn-primary" style="background-color: #517fa4!important;">Login with Instagram</a>
                        <a href="<?php echo base_url(); ?>social/github/connect/" class="btn btn-success">Login with GitHub</a>
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