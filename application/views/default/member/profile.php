<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Profile</div>
        </div>
        <div class="panel-body">
            <form id="signupform" class="form-horizontal" role="form" method="post" action="">
                <input type="hidden" name="id" value="<?php echo $member->id; ?>" />
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo !empty($member->email)?$member->email:""; ?>">
                        <?php echo getFormError("email"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-md-3 control-label">First Name</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo !empty($member->firstName)?$member->firstName:""; ?>"/>
                        <?php echo getFormError("firstName"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-md-3 control-label">Last Name</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo !empty($member->lastName)?$member->lastName:""; ?>"/>
                        <?php echo getFormError("lastName"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-md-3 control-label">Phone</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo !empty($member->phone)?$member->phone:""; ?>"/>
                        <?php echo getFormError("phone"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-3 control-label">Description</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo !empty($member->description)?$member->description:""; ?>"/>
                        <?php echo getFormError("description"); ?>
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