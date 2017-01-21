<?php
require_once('connection.php');
include("header.php");
$email= $_SESSION['email'];
if(strpos($email,"masomo.com")!==false){
    include("AdminSidebar.php");
}
else{
    include("Sidebar.php");
}
?>
<div class="col-sm-9 padding-right">
    <div class="col-sm-9 padding-right">
        <p>Welcome to <span style="font-size:15px; font-weight:600">Masomo Revision PORTAL.</span>
            Use the links on the left to navigate through the system.</p>
    </div>
    <div class="col-sm-12 padding-right">
        <div class="features_items"><!--features_items-->
            <!-- <h2 class="title text-center">Your Details</h2>-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #3381B5; color: #FFFFFF;">
                            YOUR DETAILS
                        </div>
                        <div class="panel-body">
                            <?php
                            echo "<b>Name:</b> ". $_SESSION['fname']."&nbsp". $_SESSION['sname']."<br><br>";
                            echo "<b>Email:</b> ".$_SESSION['email']."<br><br>";
                            echo "<b>Phone Number:</b> ".$_SESSION['phone'];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #3381B5; color: #FFFFFF;">
                            PERFORMACE SUMMARY
                        </div>
                        <div class="panel-body">
                            <?php
                            $userid=$_SESSION['Id'];
                            $query=mysqli_query($con,"CALL sp_getCountQuestionsDone('$userid')");
                           
                            if(mysqli_num_rows($query)>0){
                                $query = mysqli_query($con, "select count(questionsdone.DId) as Done from questions inner join questionsdone on questions.QId=questionsdone.QId inner join subjects on subjects.SId=questions.Subject where UserId='$userid'");
                                $questionsdone = mysqli_fetch_array($query);
                                $query=mysqli_query($con,"select count(*) as correct from questionsdone inner join correctanswers on questionsdone.AId=correctanswers.CAId Inner join questions on questions.QId=questionsdone.QId where UserId='$userid'");
                                $correctdone = mysqli_fetch_array($query);
                                echo '<table class="table table-responsive">';
                                echo "<tr>";
                                echo "<td><b>Questions Done</b>";
                                echo "</td>";
                                echo "<td>";
                                echo $questionsdone['Done'];
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><b>Correct Questions Done</b>";
                                echo "</td>";
                                echo "<td>";
                                echo $correctdone['correct'];
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                            }
                            else{
                                echo "<h3>No Question Done. Click on subject link to start.</h3>";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #3381B5; color: #FFFFFF;">
                        RESET PASSWORD
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($_POST['Reset'])){
                            //$email=$_POST['Email'];
                            $pass=md5($_POST['Password']);
                            $newpass=md5($_POST['NewPassword']);
                            $query=mysqli_query($con,"select * from users where Email='$email' and Password='$pass'");
                            if(mysqli_num_rows($query)>0){
                                mysqli_query($con,"Update users set Password='$newpass' where Email='$email'");
                                echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                                    Password Changed Successful.
                                    </div>';
                            }
                            else{
                                echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Incorrect Credentials.
                                    </div>';
                            }

                        }
                        ?>
                        <form action="profile.php" method="post">
                            <div class="form-group">
                                <label for="Email">
                                    Email:
                                </label>
                                <input type="email" name="Email" class="form-control" id="Email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label for="Password">
                                    Password:
                                </label>
                                <input type="password" name="Password" class="form-control" id="Password" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">
                                    New Password:
                                </label>
                                <input type="password" name="NewPassword" class="form-control" id="pass" placeholder="Enter New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="conpass">
                                    Confirm Password:
                                </label>
                                <input type="password" name="ConPassword" class="form-control" id="conpass" placeholder="Enter New Password" required onkeyup="checkPass2(); return false;">
                                <span id="confirmMessage2" class="confirmMessag2"></span>
                            </div>
                            <button type="submit" class="btn btn-success col-sm-12" name="Reset"><span class="glyphicon glyphicon-record"></span>&nbsp;&nbsp; Reset Password</button>
                            <br><br>
                            <button type="reset" class="btn btn-danger col-sm-12"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp; Clear Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php
include("footer.php");
?>	   