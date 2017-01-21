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
    <div class="col-sm-12 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Add Subject</h2>
            <?php
                $id= $_GET['Id'];
                $query=mysqli_query($con,"select * from subjects where SId=$id");
                if(mysqli_num_rows($query)>0){
                    $data=mysqli_fetch_array($query);
                    $subject=$data['Subject'];
            ?>
            <form method="post" action="AddSubject.php">
                <div class="form-group">
                    <label for="Subject">
                        Subject:
                    </label>
                    <input type="text" name="SubjectEdit" class="form-control" id="subject"  value="<?php echo $subject;?>" placeholder="Enter Subject" required>
                </div>
                <input type="text" name="subjectid" value="<?php echo $id;?>" style="display: none;">
                <button type="submit" class="btn btn-success col-sm-12" name="EditSubject"><span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp; SAVE CHANGES</button>
            </form>
            <?php
                }
            else{
                echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    INVALID SUBJECT.
                                    </div>';
            }
            ?>
        </div>
    </div>
</div>
</section>
<?php
include("footer.php");
?>	   