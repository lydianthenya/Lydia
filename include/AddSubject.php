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
            if(isset($_GET['subject_id'])){
                $id=$_GET['subject_id'];
                mysqli_query($con,"Delete from subjects where SId=$id");
                echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;&nbsp;
                                    Subject Deleted.
                                    </div>';
            }
            ?>
            <?php
            if(isset($_POST['EditSubject'])){
                $sub=$_POST['SubjectEdit'];
                $id=$_POST['subjectid'];
                $query=mysqli_query($con,"update subjects set Subject='$sub' where SId=$id");
                echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                                    Edit Successful.
                                    </div>';
            }
            if(isset($_POST['AddSubject'])){
                $subject=$_POST['Subject'];
                $query=mysqli_query($con,"CALL sp_CheckSubject('$subject')");
                mysqli_next_result($con);
                if(mysqli_num_rows($query)>0){
                    echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Subject exists.
                                    </div>';
                }
                else{
                    mysqli_query($con,"CALL sp_AddSubject('$subject')");
                    echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                                    Subject Added.
                                    </div>';
                }
            }
            ?>
            <form method="post" action="AddSubject.php">
                <div class="form-group">
                    <label for="Subject">
                        Subject:
                    </label>
                    <input type="text" name="Subject" class="form-control" id="subject" placeholder="Enter Subject" required>
                </div>
                <button type="submit" class="btn btn-success col-sm-12" name="AddSubject"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; ADD SUBJECT</button>
            </form>
        </div>
        <div class="features_items"><!--features_items-->
            <br><br><br>
            <h2 class="title text-center">Subjects</h2>
            <table class="table table-responsive">
                <th>#</th>
                <th>Subject</th>
                <th>Edit</th>
                <th>Delete</th>
                <?php
                $query=mysqli_query($con,"CALL sp_GetSubjects()");
                $i=1;
                while($data=mysqli_fetch_array($query)){
                    $id=$data['SId'];
                    echo "<tr>";
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $data['Subject'];
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='EditSubject.php?Id=$id' data-class='' data-toggle='tooltip' data-placement='right' title='Click To Edit' class='EditEmp edit'><span class='glyphicon glyphicon-edit'></span><a/>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='javascript:DeleteSubject($id)' data-toggle='tooltip' data-placement='right' title='Click To Delete' class='delete'><span class='glyphicon glyphicon-remove-circle'></span><a/>";
                    echo "</td>";
                    echo "</tr>";
                    $i=$i+1;
                }
                ?>
            </table>
        </div>
    </div>
</div>
</section>
<?php
include("footer.php");
?>	   