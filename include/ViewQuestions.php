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
            <h2 class="title text-center">All questions</h2>
            <?php
            if(isset($_GET['question_id'])){
                $id=$_GET['question_id'];
                mysqli_query($con,"Delete from questions where QId=$id");
                echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;&nbsp;
                                    Question Deleted.
                                    </div>';
            }
            if(isset($_POST['EditQuestion'])){
                $question=$_POST['question'];
                $AnswersA=$_POST['AnswersA'];
                $AnswersB=$_POST['AnswersB'];
                $AnswersC=$_POST['AnswersC'];
                $AnswersD=$_POST['AnswersD'];
                $subject=$_POST['Subject'];
                $class=$_POST['class'];
                $Aid=$_POST['Aid'];
                $Bid=$_POST['Bid'];
                $Cid=$_POST['Cid'];
                $Did=$_POST['Did'];
                $CorrectAnswer=$_POST['CorrectAnswer'];
                $Qid=$_POST['questionid'];
                $query=mysqli_query($con,"select * from subjects where Subject='$subject'");
                $data=mysqli_fetch_array($query);
                $sid=$data['SId'];
                mysqli_query($con,"update questions set Question='$question',Class='$class',Subject='$sid' where Qid=$Qid");
                mysqli_query($con,"update answers set Answer='$AnswersA' where AId=$Aid");
                mysqli_query($con,"update answers set Answer='$AnswersB' where AId=$Bid");
                mysqli_query($con,"update answers set Answer='$AnswersC' where AId=$Cid");
                mysqli_query($con,"update answers set Answer='$AnswersD' where AId=$Did");
                mysqli_query($con,"update correctanswers set CorrectAnswer='$CorrectAnswer' where QId=$Qid");
                echo '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                     Edit Successful.
                     </div>';
            }
            ?>
            <table class="table table-responsive">
                <th>#</th>
                <th>Question</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Edit</th>
                <th>Delete</th>
                <?php
                $query=mysqli_query($con,"CALL sp_getQuestions()");
                $i=1;
                while($data=mysqli_fetch_array($query)){
                    $id=$data['QId'];
                    echo "<tr>";
                    echo "<td>";
                    echo $i.".";
                    echo "</td>";
                    echo "<td>";
                    echo $data['Question'];
                    echo "</td>";
                    echo "<td>";
                    echo $data['Class'];
                    echo "</td>";
                    echo "<td>";
                    echo $data['Subject'];
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='EditQuestions.php?id=$id' data-class='' data-toggle='tooltip' data-placement='right' title='Click To Edit' class='EditEmp edit'><span class='glyphicon glyphicon-edit'></span><a/>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='javascript:DeleteQuestion($id)' data-toggle='tooltip' data-placement='right' title='Click To Delete' class='delete'><span class='glyphicon glyphicon-remove-circle'></span><a/>";
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