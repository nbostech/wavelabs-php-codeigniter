<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px">
                <a id="signinlink" href="<?php echo base_url(); ?>home/login/">Sign In</a>
            </div>
        </div>
        <div class="panel-body">
            <form id="signupform" class="form-horizontal" role="form" method="post" action="">
                <?php getMessage(); ?>
                <div id="signupalert" style="display:none" class="alert alert-danger">
                    <p>Error:</p>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="usd" class="col-md-3 control-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo !empty($_POST['username'])?$_POST['username']:""; ?>">
                        <?php echo getFormError("username"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>

                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" placeholder="password">
                        <?php echo getFormError("password"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo !empty($_POST['email'])?$_POST['email']:""; ?>">
                        <?php echo getFormError("email"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-md-3 control-label">First Name</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo !empty($_POST['firstName'])?$_POST['firstName']:""; ?>"/>
                        <?php echo getFormError("firstName"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-md-3 control-label">Last Name</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo !empty($_POST['lastName'])?$_POST['lastName']:""; ?>"/>
                        <?php echo getFormError("lastName"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>
                            &nbsp Sign Up
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>