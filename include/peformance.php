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
            <h2 class="title text-center">All Users PERFORMANCE</h2>
            <table class="table table-responsive">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
		        <th>Questions Done</th>
		        <th>Correct Questions</th>
                <th>View More</th>
                <?php
                $queryuser=mysqli_query($con,"CALL sp_getUsers()");
		mysqli_next_result($con);
                $i=1;
                while($data=mysqli_fetch_array($queryuser)){
		    $userid=$data['UserId'];
		    $query = mysqli_query($con, "select count(questionsdone.DId) as Done from questions inner join questionsdone on questions.QId=questionsdone.QId inner join subjects on subjects.SId=questions.Subject where UserId='$userid'");
                    $questionsdone = mysqli_fetch_array($query);
                    $query=mysqli_query($con,"select count(*) as correct from questionsdone inner join correctanswers on questionsdone.AId=correctanswers.CAId Inner join questions on questions.QId=questionsdone.QId where UserId='$userid'");
                    $correctdone = mysqli_fetch_array($query);
                    echo "<tr>";
                    echo "<td>";
                    echo $i.".";
                    echo "</td>";
                    echo "<td>";
                    echo $data['FirstName']."&nbsp".$data['SecondName'];
                    echo "</td>";
                    echo "<td>";
                    echo $data['Email'];
                    echo "</td>";
		    echo "<td>";
                    echo $questionsdone['Done'];
                    echo "</td>";
                    echo "<td>";
                    echo $correctdone['correct'];
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='MorePerformance.php?id=$userid'data-toggle='tooltip' data-placement='right' title='View Detailed Performance' class='edit'><i class='glyphicon glyphicon-eye-open'></i></a>";
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