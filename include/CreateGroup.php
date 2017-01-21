<?php
require_once('connection.php');
include("header.php");
include("AdminSidebar.php");
?>
<div class="col-sm-9 padding-right">
    <div class="col-sm-12 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">CREATE GROUP</h2>
            <?php
            if(isset($_POST['CreateGroup'])){
                $name=$_POST['name'];
                $Description=$_POST['Description'];
                $createdby= $_SESSION['Id'];
                $query=mysqli_query($con,"CALL sp_CheckGroup('$name')");
                mysqli_next_result($con);
                if(mysqli_num_rows($query)>0){
                    echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Group exists.
                                    </div>';
                }
                else{
                    mysqli_query($con,"CALL sp_CreateGroup('$name','$Description','$createdby')");
                    mysqli_query($con,"CALL sp_AddMembers('$createdby','$name')");
                    echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                                    Group Created.
                                    </div>';
                }
            }
            ?>
            <form method="post" action="CreateGroup.php">
                <div class="form-group">
                    <label for="name">
                        Group Name:
                    </label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Group Name" required>
                </div>
                <div class="form-group">
                    <label for="Description">
                        Question:
                    </label>
                    <textarea name="Description" class="form-control" id="Description" placeholder="Enter Description ">

                    </textarea>
                </div>
                <button type="submit" class="btn btn-success col-sm-12" name="CreateGroup"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; CREATE GROUP</button>
            </form>
            <br><br>
        </div>
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Your Groups</h2>
            <table class="table table-responsive">
                <?php
                $id=$_SESSION['Id'];
                $query=mysqli_query($con,"CALL sp_getCreatedGroups('$id')");
                if(mysqli_num_rows($query)>0) {
                    echo '<th>#</th>
                    <th>Group Name</th>
                    <th>Group Description</th>
                     <th>Edit</th>
                    <th>Delete</th>';
                    $i = 1;
                    while ($data = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>";
                        echo $i;
                        echo "</td>";
                        echo "<td>";
                        echo $data['Name'];
                        echo "</td>";
                        echo "<td>";
                        echo $data['Description'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='#' data-class='' data-toggle='tooltip' data-placement='right' title='Click To Edit' class='EditEmp edit'><span class='glyphicon glyphicon-edit'></span><a/>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href=# data-toggle='tooltip' data-placement='right' title='Click To Delete' class='delete'><span class='glyphicon glyphicon-remove-circle'></span><a/>";
                        echo "</td>";
                        echo "</tr>";
                        $i = $i + 1;
                    }
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