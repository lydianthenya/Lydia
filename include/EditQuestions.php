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
            $id=$_GET['id'];
            $query1=mysqli_query($con,"select * from questions where QId=$id");
            //mysqli_next_result($con);
            if(mysqli_num_rows($query1)>0) {
                while ($data1 = mysqli_fetch_array($query1)) {
                    $question = $data1['Question'];
                    $class = $data1['Class'];
                    $subjectid = $data1['Subject'];
                }
                $query2 = mysqli_query($con, "select * from subjects where SId='$subjectid'");
                $data2 = mysqli_fetch_array($query2);
                $subject = $data2['Subject'];
                $query3 = mysqli_query($con, "select * from answers where QId=$id");
                $i = 0;
                while ($data3 = mysqli_fetch_array($query3)) {
                    if ($i == 0) {
                        $answerA = $data3['Answer'];
                        $Aid=$data3['AId'];
                    } elseif ($i == 1) {
                        $answerB = $data3['Answer'];
                        $Bid=$data3['AId'];
                    } elseif ($i == 2) {
                        $answerC = $data3['Answer'];
                        $Cid=$data3['AId'];
                    } elseif ($i == 3) {
                        $answerD = $data3['Answer'];
                        $Did=$data3['AId'];
                    }
                    $i = $i + 1;
                }
                $query4 = mysqli_query($con, "select * from correctanswers where QId=$id");
                $data4 = mysqli_fetch_array($query4);
                $correctans = $data4['CorrectAnswer'];
                ?>
                <form method="post" action="ViewQuestions.php">
                    <input type="text" name="questionid" value="<?php echo $id; ?>" style="display: none;">
                    <input type="text" name="Aid" value="<?php echo $Aid; ?>" style="display: none;">
                    <input type="text" name="Bid" value="<?php echo $Bid; ?>"style="display: none;">
                    <input type="text" name="Cid" value="<?php echo $Cid; ?>"style="display: none;">
                    <input type="text" name="Did" value="<?php echo $Did; ?>"style="display: none;">
                    <div class="form-group">
                        <label for="Subject">
                            Subject:
                        </label>
                        <select name="Subject" class="form-control" id="Subject" required="">
                            <option>
                                <?php echo $subject; ?>
                            </option>
                            <?php
                            $query = mysqli_query($con, "CALL sp_GetSubjects()");
                            //mysqli_next_result($con);
                            while ($data = mysqli_fetch_array($query)) {
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
                            <option><?php
                                echo $class;
                                ?></option>
                            <option>Class 6</option>
                            <option>Class 7</option>
                            <option>Class 8</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question">
                            Question:
                        </label>
                        <textarea name="question" class="form-control" id="question"
                                  placeholder="Enter Question "><?php echo $question; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="AnswersA">
                            Answer A:
                        </label>
                        <input type="text" name="AnswersA" class="form-control" id="AnswersA"
                               placeholder="Enter First Answer" value="<?php echo $answerA; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="AnswersB">
                            Answer B:
                        </label>
                        <input type="text" name="AnswersB" class="form-control" id="AnswersB"
                               placeholder="Enter Second Answer" value="<?php echo $answerB; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="AnswersC">
                            Answer C:
                        </label>
                        <input type="text" name="AnswersC" class="form-control" id="AnswersC"
                               placeholder="Enter Third Answer" value="<?php echo $answerC; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="AnswersD">
                            Answer D:
                        </label>
                        <input type="text" name="AnswersD" class="form-control" id="AnswersD"
                               placeholder="Enter Fourth Answer" value="<?php echo $answerD; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="CorrectAnswer">
                            Correct Answer:
                        </label>
                        <input type="text" name="CorrectAnswer" class="form-control" id="CorrectAnswer"
                               placeholder="Enter Correct Answer" value="<?php echo $correctans; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success col-sm-12" name="EditQuestion"><span
                            class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp; SAVE CHANGES
                    </button>
                </form>
                <br><br>
            <?php
            }
            else{
                echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    INVALID QUESTION.
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