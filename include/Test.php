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
$subject=$_GET['Subject'];
$class=$_GET['Class'];
?>
<div class="col-sm-9 padding-right">
    <div class="col-sm-12 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center"><?php echo $subject.' Test';?></h2>
            <?php
            if(isset($_GET['answer'])){
                $qid=$_GET['Qid'];
                $aid=$_GET['correct'];
                $user= $_SESSION['Id'];
                mysqli_query($con,"CALL sp_InsertDoneQuestion('$user','$qid','$aid')");
                $query=mysqli_query($con,"CALL sp_checkCorrectAnswer('$qid','$aid')");
                mysqli_next_result($con);
                if(mysqli_num_rows($query)>0){
                    echo '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;&nbsp;
                     Correct Answer.
                     </div>';
                }
                else{
                    echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-thumbs-down"></span>&nbsp;&nbsp;&nbsp;
                                     Wrong Answer!!
                                    </div>';
                }
            }
            ?>
            <form method="get" action="Test.php">
                <?php
                $class="Class ".$class;
                $user= $_SESSION['Id'];
                $query2=mysqli_query($con,"CALL sp_getQuestionTest('$subject','$class','$user')");
                if(mysqli_num_rows($query2)>0){
                mysqli_next_result($con);
                echo '<table class="table table-responsive">';
                while ($data1 = mysqli_fetch_array($query2)) {
                    echo '<tr><td>';
                    echo "<b>Question:</b>";
                    echo '</td><td>' . $data1['Question'] . '</td></tr>';
                    $questionid = $data1['QId'];
                }
                echo '</table>';
                $query = mysqli_query($con, "CALL sp_getAnswersTest('$questionid')");
                $i = 1;
                echo '<table class="table table-responsive">';
                while ($data = mysqli_fetch_array($query)) {
                    echo '<tr><td><b>Answer ' . $i . ':</b></td><td>';
                    echo $data['Answer'] . '</td>';
                    echo '<td><input type="radio" name="correct" value="' . $data['AId'] . '" class="form-control" required></td></tr>';
                    $i = $i + 1;
                }
                echo '</table>';
                ?>
                <input type="text" name="Subject" value="<?php echo $subject; ?>" style="display: none">
                <input type="text" name="Qid" value="<?php echo $questionid; ?>" style="display: none">
                <input type="text" name="Class" value="<?php echo $_GET['Class']; ?>" style="display: none">
                <button type="submit" class="btn btn-success col-sm-12" name="answer"><span
                        class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp; Submit Answer
                </button>
            </form>
        <br><br>
        <?php
        }
        else{
            echo '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;&nbsp;
                     No Question, Please using revision section to access the questions done.
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