<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li style="color:#000000; margin-right:30px;"><a href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i>&nbsp;Dashboard</a></li>
                            <li style="color:#000000; margin-right:30px;"><a href="peformance.php"><i class="glyphicon glyphicon-certificate"></i>&nbsp;Peformance</a></li>
			    <li style="color:#000000; margin-right:30px;"><a href="#"><i class="glyphicon glyphicon-question-sign"></i>&nbsp;Help</a></li>
                        </ul>
                    </div>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li style="color:#000000"><span class="title text-center"><i class="glyphicon glyphicon-blackboard"></i>&nbsp;Questions</span></li>
                            <li><a href="AddQuestion.php">Add Question</a></li>
                            <li><a href="ViewQuestions.php">View Questions</a></li>
                        </ul>
                    </div>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li style="color:#000000"><span class="title text-center"><i class="glyphicon glyphicon-education"></i>&nbsp;Class</span></li>
                            <li><a href="#" id="class6">Class 6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i> </a>
                                <ul id="class6sub">
                                    <?php
                                    $query=mysqli_query($con,"CALL sp_GetSubjects()");
                                    mysqli_next_result($con);
                                    while($data=mysqli_fetch_array($query)){
                                        echo '<li><a href="Test.php?Subject='.$data['Subject'].'&&Class=6">';
                                        echo $data['Subject'];
                                        echo '</a></li>';

                                    }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="#" id="class7">Class 7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i> </a>
                                <ul id="class7sub">
                                    <?php
                                    $query=mysqli_query($con,"CALL sp_GetSubjects()");
                                    mysqli_next_result($con);
                                    while($data=mysqli_fetch_array($query)){
                                        echo '<li><a href="Test.php?Subject='.$data['Subject'].'&&Class=7">';
                                        echo $data['Subject'];
                                        echo '</a></li>';

                                    }
                                    ?>
                                </ul></li>
                            <li><a href="#" id="class8">Class 8&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i> </a>
                                <ul id="class8sub">
                                    <?php
                                    $query=mysqli_query($con,"CALL sp_GetSubjects()");
                                    mysqli_next_result($con);
                                    while($data=mysqli_fetch_array($query)){
                                        echo '<li><a href="Test.php?Subject='.$data['Subject'].'&&Class=8">';
                                        echo $data['Subject'];
                                        echo '</a></li>';

                                    }
                                    ?>
                                </ul></li>
                        </ul>
                    </div>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li style="color:#000000"><span class="title text-center"><i class="glyphicon glyphicon-backward"></i>&nbsp;Revision</span></li>
                            <li><a href="#" id="class6Rev">Class 6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i> </a>
                                <ul id="class6subRev">
                                    <?php
                                    $user= $_SESSION['Id'];
                                    $query=mysqli_query($con,"CALL sp_getSubjectRevision('$user')");
                                    mysqli_next_result($con);
                                    if(mysqli_num_rows($query)>0) {
                                        while ($data = mysqli_fetch_array($query)) {
                                            $subjectid = $data['Subject'];
                                            $query2 = mysqli_query($con, "CALL sp_GetRevisionSubject('$subjectid')");
                                            mysqli_next_result($con);
                                            while ($data2 = mysqli_fetch_array($query2)) {
                                                echo '<li><a href="Revision.php?Subject=' . $data2['Subject'] . '&&Class=6">';
                                                echo $data2['Subject'];
                                                echo '</a></li>';
                                            }
                                        }
                                    }
                                    else {
                                        echo "No Subject For Revision";
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="#" id="class7Rev">Class 7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i> </a>
                                <ul id="class7subRev">
                                    <?php
                                    $user= $_SESSION['Id'];
                                    $query=mysqli_query($con,"CALL sp_getSubjectRevision('$user')");
                                    mysqli_next_result($con);
                                    if(mysqli_num_rows($query)>0) {
                                        while ($data = mysqli_fetch_array($query)) {
                                            $subjectid = $data['Subject'];
                                            $query2 = mysqli_query($con, "CALL sp_GetRevisionSubject('$subjectid')");
                                            mysqli_next_result($con);
                                            while ($data2 = mysqli_fetch_array($query2)) {
                                                echo '<li><a href="Revision.php?Subject=' . $data2['Subject'] . '&&Class=7">';
                                                echo $data2['Subject'];
                                                echo '</a></li>';
                                            }
                                        }
                                    }
                                    else {
                                        echo "No Subject For Revision";
                                    }
                                    ?>
                                </ul></li>
                            <li><a href="#" id="class8Rev">Class 8&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i> </a>
                                <ul id="class8subRev">
                                    <?php
                                    $user= $_SESSION['Id'];
                                    $query=mysqli_query($con,"CALL sp_getSubjectRevision('$user')");
                                    mysqli_next_result($con);
                                    if(mysqli_num_rows($query)>0) {
                                        while ($data = mysqli_fetch_array($query)) {
                                            $subjectid = $data['Subject'];
                                            $query2 = mysqli_query($con, "CALL sp_GetRevisionSubject('$subjectid')");
                                            mysqli_next_result($con);
                                            while ($data2 = mysqli_fetch_array($query2)) {
                                                echo '<li><a href="Revision.php?Subject=' . $data2['Subject'] . '&&Class=8">';
                                                echo $data2['Subject'];
                                                echo '</a></li>';
                                            }
                                        }
                                    }
                                    else {
                                        echo "No Subject For Revision";
                                    }
                                    ?>
                                </ul></li>
                        </ul>
                    </div>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li style="color:#000000"><span class="title text-center"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Manage</span></li>
                            <li><a href="users.php">Users</a></li>
                            <li><a href="AddSubject.php">Subjects</a></li>
                        </ul>
                    </div>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li style="color:#000000"><span class="title text-center"><i class="glyphicon glyphicon-user"></i>&nbsp;Account</span></li>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="Logout.php">SignOut</a></li>
                        </ul>
                    </div>
                </div>
            </div>