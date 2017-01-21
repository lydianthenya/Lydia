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
            <h2 class="title text-center">All Users</h2>
            <?php
            if(isset($_GET['user_id'])){
                $id=$_GET['user_id'];
                mysqli_query($con,"Delete from users where UserId=$id");
                echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;&nbsp;
                                    User Removed From Masomo.
                                    </div>';
            }?>
            <table class="table table-responsive">
                <th>#</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Delete</th>
                <?php
                $query=mysqli_query($con,"CALL sp_getUsers()");
                $i=1;
                while($data=mysqli_fetch_array($query)){
                    $id=$data['UserId'];
                    echo "<tr>";
                    echo "<td>";
                    echo $i.".";
                    echo "</td>";
                    echo "<td>";
                    echo $data['FirstName']."&nbsp".$data['SecondName'];
                    echo "</td>";
                    echo "<td>";
                    echo $data['Phone'];
                    echo "</td>";
                    echo "<td>";
                    echo $data['Email'];
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='javascript:DeleteUser($id)' data-toggle='tooltip' data-placement='right' title='Click To Delete' class='delete'><span class='glyphicon glyphicon-remove-circle'></span><a/>";
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