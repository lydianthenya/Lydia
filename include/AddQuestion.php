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
            <h2 class="title text-center">Add Questions</h2>
            <?php
            if(isset($_POST['AddQuestion'])){
                $question=$_POST['question'];
                $AnswersA=$_POST['AnswersA'];
                $AnswersB=$_POST['AnswersB'];
                $AnswersC=$_POST['AnswersC'];
                $AnswersD=$_POST['AnswersD'];
                $subject=$_POST['Subject'];
                $class=$_POST['class'];
                $CorrectAnswer=$_POST['CorrectAnswer'];
                mysqli_query($con,"CALL sp_AddQuestion('$subject','$question','$class')");
                mysqli_query($con,"CALL sp_AddAnswers('$AnswersA','$question')");
                mysqli_query($con,"CALL sp_AddAnswers('$AnswersB','$question')");
                mysqli_query($con,"CALL sp_AddAnswers('$AnswersC','$question')");
                mysqli_query($con,"CALL sp_AddAnswers('$AnswersD','$question')");
                mysqli_query($con,"CALL sp_AddCorrectAnswer('$CorrectAnswer','$question')");
                echo '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                     Question Added.
                     </div>';
            }
            ?>
            <form method="post" action="AddQuestion.php">
                <div class="form-group">
                    <label for="Subject">
                        Subject:
                    </label>
                    <select name="Subject" class="form-control" id="Subject" required="">
                       <option></option>
                        <?php
                        $query=mysqli_query($con,"CALL sp_GetSubjects()");
                        mysqli_next_result($con);
                        while($data=mysqli_fetch_array($query)){
                            echo "<option>";
                            echo $data['Subject'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Class">
                        Class:
                    </label>
                    <select name="class" class="form-control" id="class" required="">
                        <option></option>
                        <option>Class 6</option>
                        <option>Class 7</option>
                        <option>Class 8</option>
                        </select>
                    </div>
                <div class="form-group">
                    <label for="question">
                        Question:
                    </label>
                    <textarea name="question" class="form-control" id="question" placeholder="Enter Question ">

                    </textarea>
                </div>
                <div class="form-group">
                    <label for="AnswersA">
                        Answer A:
                    </label>
                    <input type="text" name="AnswersA" class="form-control" id="AnswersA" placeholder="Enter First Answer" required>
                </div>
                <div class="form-group">
                    <label for="AnswersB">
                        Answer B:
                    </label>
                    <input type="text" name="AnswersB" class="form-control" id="AnswersB" placeholder="Enter Second Answer" required>
                </div>
                <div class="form-group">
                    <label for="AnswersC">
                        Answer C:
                    </label>
                    <input type="text" name="AnswersC" class="form-control" id="AnswersC" placeholder="Enter Third Answer" required>
                </div>
                <div class="form-group">
                    <label for="AnswersD">
                        Answer D:
                    </label>
                    <input type="text" name="AnswersD" class="form-control" id="AnswersD" placeholder="Enter Fourth Answer" required>
                </div> <div class="form-group">
                    <label for="CorrectAnswer">
                        Correct Answer:
                    </label>
                    <input type="text" name="CorrectAnswer" class="form-control" id="CorrectAnswer" placeholder="Enter Correct Answer" required>
                </div>
                <button type="submit" class="btn btn-success col-sm-12" name="AddQuestion"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; ADD QUESTION</button>
            </form>
            <br><br>
        </div>
    </div>
</div>
</section>
<?php
include("footer.php");
?>	   