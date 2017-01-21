<?php
/**
 * Created by PhpStorm.
 * User: Limo
 * Date: 16/08/2015
 * Time: 08:55
 */
require_once("include/connection.php");
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
        function checkPass2()
        {
            var pass1 = document.getElementById('pass');
            var pass2 = document.getElementById('conpass');
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

    <div class="index">
        <h5 style="text-align: center; font-size: 18px">Welcome to <B>MASOMO</B>, number one revision portal. Provide <b>correct</b> log in credentials to access online revision question.<br> You can sign up if you don't have an account.</h5>
        <!-- Log In-->
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
                <div class="panel panel-success">
                    <div class="panel-heading intro" style="background-color: #3381B5; color: #FFFFFF;">
                        <span class="glyphicon glyphicon-adjust"></span>&nbsp;
                        Forgot Password.
                    </div>
                    <div class="panel-body">
                        <?php
                        ?>
                        <form action="index.php" method="post">
                            <?php
                            if(isset($_POST['forgotpass'])){
                                $Email=mysqli_real_escape_string($con,$_POST['Email']);
                                $query=mysqli_query($con,"select * from users where Email='$Email'");
                                if(mysqli_num_rows($query)>0){
                            $data = mysqli_fetch_array($query);
                            $q = $data['Question'];
                            ?>
                            <div class="form-group">
                                <label for="question">
                                    Security Question:
                                </label>
                                <Label class="form-control" id="question">
                                    <?php
                                    echo $q;
                                    ?>
                                </Label>
                            </div>
                            <input type="text" name="email" value="<?php echo $Email;?>" style="display: none">
                            <div class="form-group">
                                <label for="ans">
                                    Security Answer:
                                </label>
                                <input type="text" name="ans" class="form-control" id="ans" placeholder="Enter Security"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="pass">
                                    Password:
                                </label>
                                <input type="password" name="pass" class="form-control" id="pass"
                                       placeholder="Enter New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="conpass">
                                    Confirm password:
                                </label>
                                <input type="password" name="conpass" class="form-control" id="conpass"
                                       placeholder="Enter Confirm Password" required onkeyup="checkPass2(); return false;">
                                <span id="confirmMessage2" class="confirmMessag2"></span>
                            </div>

                            <button type="submit" class="btn btn-success col-sm-12" name="forgot"><span
                                    class="glyphicon glyphicon-send"></span>&nbsp;&nbsp; Submit
                            </button>
                            <br><br>
                        </form>
                    <?php
                    }
                    else{
                        echo '<div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
                                    Invalid Email.
                                    <a href="index.php">Back</a>
                                    </div>';
                    }
                    }
                        ?>
                    </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
</body>
</html>