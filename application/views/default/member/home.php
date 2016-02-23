<div class="container">
    <br/>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Welcome <?php echo !empty($member->firstName)?$member->firstName:""; ?></h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td>Email</td>
                    <td><?php echo !empty($member->email)?$member->email:""; ?></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?php echo !empty($member->firstName)?$member->firstName:""; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo !empty($member->lastName)?$member->lastName:""; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo !empty($member->phone)?$member->phone:""; ?></td>
                </tr>
                <tr>
                    <td>About</td>
                    <td><?php echo !empty($member->description)?$member->description:""; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>