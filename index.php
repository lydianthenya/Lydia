<?php
/**
 * Created by PhpStorm.
 * User: Limo
 * Date: 16/08/2015
 * Time: 08:55
 */
 ob_start();
 session_start();
require_once("include/connection.php");
//include("include/header.php");
?>
<html>
<head>
    <title>Masomo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-1.11.3.min%20(1).js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function(){
            $('#forgotlink').click(function(){
                $('#forgot').css("display","block");
            });
        });
        function checkPass()
        {
            var pass1 = document.getElementById('Password');
            var pass2 = document.getElementById('conpassword');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage2');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if(pass1.value == pass2.value){
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }
    </script>
</head>
<body>

<div class="container" id="wrapper">
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="logo">
                                <ul class="nav nav-pills">
                                    <li><a href="dashboard.php"><span class="glyphicon glyphicon-book"></span> MASOMO</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">

                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->
        </header>
<div class="index">
    <h5 style="text-align: center; font-size: 18px">Welcome to <B>MASOMO</B>, number one revision portal. Provide <b>correct</b> log in credentials to access online revision question.<br> You can sign up if you don't have an account.</h5>
    <?php
    if(isset($_POST['forgot'])){
        $ans=mysqli_real_escape_string($con,$_POST['ans']);
        $pass=md5(mysqli_real_escape_string($con,$_POST['pass']));
        $Email=mysqli_real_escape_string($con,$_POST['email']);
        $query=mysqli_query($con,"Select * from users where Email='$Email' and Ans='$ans'");
        if(mysqli_num_rows($query)>0){
            mysqli_query($con,"Update users set Password='$pass' where Email='$Email'");
            echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Password Changed Successful.
                                    </div>';
        }
        else{
            echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Incorrect Answer.
                                    </div>';
        }
    }
    ?>
    <!-- Sign up-->
                <div class="col-sm-5">
                    <div class="panel panel-success">
                        <div class="panel-heading intro" style="background-color: #3381B5;color: #FFFFFF;">
                            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                            Sign Up
                        </div>
                        <div class="panel-body">
                            <?php
                            if(isset($_POST['SignUp'])){
                                $fname=mysqli_real_escape_string($con,$_POST['FirstName']);
                                $lname=mysqli_real_escape_string($con,$_POST['SecondName']);
                                $phone=mysqli_real_escape_string($con,$_POST['Phone']);
                                $email=mysqli_real_escape_string($con,$_POST['Email']);
                                $password=md5(mysqli_real_escape_string($con,$_POST['Password']));
                                $query=mysqli_query($con,"CALL sp_CheckUser('$email')");
                                $question=mysqli_real_escape_string($con,$_POST['question']);
                                $ans=mysqli_real_escape_string($con,$_POST['answer']);
                                mysqli_next_result($con);
                                if(mysqli_num_rows($query)>0){
                                    echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Email Address exists.
                                    </div>';
                                }
                                else{
                                        mysqli_query($con,"CALL sp_InsertUser('$fname','$lname','$password','$email','$phone','$question','$ans')");
                                        echo '<div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-saved"></span>&nbsp;&nbsp;&nbsp;
                                    Registration Successful.
                                    </div>';
                                }
                            }
                            ?>
                            <form action="index.php" method="post">
                                <div class="form-group">
                                    <label for="FirstName">
                                        First Name:
                                    </label>
                                    <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="Enter First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="SecondName">
                                        Second Name:
                                    </label>
                                    <input type="text" name="SecondName" class="form-control" id="SecondName" placeholder="Enter Second Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Phone">
                                        Phone Number:
                                    </label>
                                    <input type="number" name="Phone" class="form-control" id="Phone" placeholder="Enter Phone Number" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <label for="Email">
                                        Email:
                                    </label>
                                    <input type="email" name="Email" class="form-control" id="Email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="question">
                                        Security Question:
                                    </label>
                                    <textarea id="question" name="question" required="" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="answer">
                                        Security Answer:
                                    </label>
                                    <input type="text" name="answer" class="form-control" id="answer" placeholder="Enter Security Answer" required>
                                </div>
                                <div class="form-group">
                                    <label for="Password">
                                        Password:
                                    </label>
                                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Enter Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="conpassword">
                                        Confirm Password:
                                    </label>
                                    <input type="password" name="Pass" class="form-control" id="conpassword" placeholder="Enter Confirm Password" required onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage2" class="confirmMessag2"></span>
                                </div>
                                <button type="submit" class="btn btn-success col-sm-12" name="SignUp"><span class="glyphicon glyphicon-save"></span>&nbsp;&nbsp; Submit Details</button>
                                <br><br>
                                <button type="reset" class="btn btn-danger col-sm-12"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp; Clear Form</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1" style="font-size: 25px;">
                    <div class="round"><b>OR</b></div>
                </div>
                <!-- Log In-->
                <div class="col-sm-5">
                    <div class="panel panel-success">
                        <div class="panel-heading intro" style="background-color: #3381B5; color: #FFFFFF;">
                            <span class="glyphicon glyphicon-log-in"></span>&nbsp;
                            Sign In.
                        </div>
                        <div class="panel-body">
                            <?php
                            if(isset($_POST['LogIn'])){
                                $email=mysqli_real_escape_string($con,$_POST['Email']);
                                $password=(mysqli_real_escape_string($con,$_POST['Password']));
                                $query=mysqli_query($con,"CALL sp_LogIn('$email','$password')");
                                mysqli_next_result($con);
                                if(mysqli_num_rows($query)>0){
                                    $Data=mysqli_fetch_array($query);
                                  
                                    $_SESSION['Id']=$Data['UserId'];
                                    $_SESSION['fname']=$Data['FirstName'];
                                    $_SESSION['sname']=$Data['SecondName'];
                                    $_SESSION['email']=$Data['Email'];
                                    $_SESSION['phone']=$Data['Phone'];
                                    $_SESSION['timeOut'] = 240;
                                    $logged = time();
                                    $_SESSION['loggedAt']= $logged;
                                    $_SESSION['isLoggedIn'] = true;
                                    header("Location:include/dashboard.php");
                                }
                                else{
                                    echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Incorrect Credentials.
                                    </div>';
                                }
                            }
                            ?>

                            <form action="index.php" method="post">
                                <div class="form-group">
                                    <label for="Email">
                                        User Name:
                                    </label>
                                    <input type="email" name="Email" class="form-control" id="Email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="Password">
                                        Password:
                                    </label>
                                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Enter Password" required>
                                </div>
                                <button type="submit" class="btn btn-success col-sm-12" name="LogIn"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp; Log In</button>
                                <br><br>
                                <button type="reset" class="btn btn-danger col-sm-12"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp; Clear Form</button>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <a href="#" id="forgotlink">Forgot Password</a>
                        </div>
                    </div>
                    <div id="forgot">
                    <div class="panel panel-success">
                        <div class="panel-heading intro" style="background-color: #3381B5; color: #FFFFFF;">
                            <span class="glyphicon glyphicon-adjust"></span>&nbsp;
                            Forgot Password.
                        </div>
                        <div class="panel-body">
                                <form action="forgotpass.php" method="post">
                                    <div class="form-group">
                                        <label for="Email">
                                            Email:
                                        </label>
                                        <input type="email" name="Email" class="form-control" id="Email" placeholder="Enter Email" required>
                                    </div>
                                    <button type="submit" class="btn btn-success col-sm-12" name="forgotpass"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp; Submit</button>
                                    <br><br>
                                </form>
                            </div>
                        </div>
                </div>
    </div>
        </div>
</div>
</body>
</html>