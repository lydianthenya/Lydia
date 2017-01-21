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
                            mysqli_next_result($con);

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
                        PERFORMANCE REPORT
                    </div>
                    <div class="panel-body">
                        <?php
                        $userid=$_SESSION['Id'];
                        $query=mysqli_query($con,"CALL sp_getCountQuestionsDone('$userid')");
                        mysqli_next_result($con);
                        if(mysqli_num_rows($query)>0){
                        ?>
                            <table class="table table-responsive">
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Questions Done</th>
                                <th>Correct Questions Done</th>
                                <th>Correct Failed</th>
                            <?php
                            $usersid=$_SESSION['Id'];
                            $subjectquery=mysqli_query($con,"select subjects.Subject,subjects.SId from subjects");
                            while($subjectdata=mysqli_fetch_array($subjectquery)){
                                $subject=$subjectdata['Subject'];
                                $subjectid=$subjectdata['SId'];
                                $query = mysqli_query($con, "select count(questionsdone.DId) as Done from questions inner join questionsdone on questions.QId=questionsdone.QId inner join subjects on subjects.SId=questions.Subject where UserId='$usersid' and questions.Class='Class 8' and questions.Subject='$subjectid'");
                                $questionsdone8 = mysqli_fetch_array($query);
                                $query = mysqli_query($con, "select count(questionsdone.DId) as Done from questions inner join questionsdone on questions.QId=questionsdone.QId inner join subjects on subjects.SId=questions.Subject where UserId='$usersid' and questions.Class='Class 7' and questions.Subject='$subjectid'");
                                $questionsdone7 = mysqli_fetch_array($query);
                                $query = mysqli_query($con, "select count(questionsdone.DId) as Done from questions inner join questionsdone on questions.QId=questionsdone.QId inner join subjects on subjects.SId=questions.Subject where UserId='$usersid' and questions.Class='Class 6' and questions.Subject='$subjectid'");
                                $questionsdone6 = mysqli_fetch_array($query);
                                $query=mysqli_query($con,"select count(*) as correct from questionsdone inner join correctanswers on questionsdone.AId=correctanswers.CAId Inner join questions on questions.QId=questionsdone.QId where UserId='$usersid' and questions.Class='Class 8' and questions.Subject='$subjectid'");
                                $correctdone8 = mysqli_fetch_array($query);
                                $query=mysqli_query($con,"select count(*) as correct from questionsdone inner join correctanswers on questionsdone.AId=correctanswers.CAId Inner join questions on questions.QId=questionsdone.QId where UserId='$usersid' and questions.Class='Class 7' and questions.Subject='$subjectid'");
                                $correctdone7 = mysqli_fetch_array($query);
                                $query=mysqli_query($con,"select count(*) as correct from questionsdone inner join correctanswers on questionsdone.AId=correctanswers.CAId Inner join questions on questions.QId=questionsdone.QId where UserId='$usersid' and questions.Class='Class 6' and questions.Subject='$subjectid'");
                                $correctdone6 = mysqli_fetch_array($query);
                                echo '<tr>';
                                echo '<td>';
                                echo "Class 6";
                                echo '</td>';
                                echo '<td>';
                                echo $subject;
                                echo '</td>';
                                echo '<td>';
                                echo $questionsdone6['Done'];
                                echo '</td>';
                                echo '<td>';
                                echo $correctdone6['correct'];
                                echo '</td>';
                                echo '<td>';
                                echo $questionsdone6['Done']-$correctdone6['correct'];
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td>';
                                echo "Class 7";
                                echo '</td>';
                                echo '<td>';
                                echo $subject;
                                echo '</td>';
                                echo '<td>';
                                echo $questionsdone7['Done'];
                                echo '</td>';
                                echo '<td>';
                                echo $correctdone7['correct'];
                                echo '</td>';
                                echo '<td>';
                                echo $questionsdone7['Done']-$correctdone7['correct'];
                                echo '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td>';
                                echo "Class 8";
                                echo '</td>';
                                echo '<td>';
                                echo $subject;
                                echo '</td>';
                                echo '<td>';
                                echo $questionsdone8['Done'];
                                echo '</td>';
                                echo '<td>';
                                echo $correctdone8['correct'];
                                echo '</td>';
                                echo '<td>';
                                echo $questionsdone8['Done']-$correctdone8['correct'];
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                            </table>
                        <?php
                         }
                        else{
                        echo "<h3>No Question Done. Click on subject link to start.</h3>";
                        }
                        ?>
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