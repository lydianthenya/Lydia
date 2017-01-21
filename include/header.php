<?php
ob_start();
session_start();
@$id=$_SESSION['Id'];
//$role=$_SESSION['role'];
if($id==""){
	header("Location:../index.php");
}
require 'timeCheck.php';
$hasSessionExpired = checkIfTimedOut();
if($hasSessionExpired)
{
    session_unset();
    header("Location:../index.php");
    exit;
}
else
{
    $_SESSION['loggedAt']= time();// update last accessed time
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masomo</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
    <script src="../js/jquery-1.11.3.min%20(1).js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/highcharts.js"></script>
    <script src="../js/exporting.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript">
        function DeleteSubject(id)
        {
            if(confirm('Are you sure you delete this record?'))
            {
                window.location.href='AddSubject.php?subject_id='+id;
            }
        }
        function DeleteQuestion(id)
        {
            if(confirm('Are you sure you delete this record?'))
            {
                window.location.href='ViewQuestions.php?question_id='+id;
            }
        }
        function DeleteUser(id)
        {
            if(confirm('Are you sure you delete this record?'))
            {
                window.location.href='users.php?user_id='+id;
            }
        }
            $(document).ready(function(){
                $('#class6').click(function(){
                    $('#class6sub').css("display","block")
                    $('#class7sub').css("display","none");
                    $('#class8sub').css("display","none");
                });
            });
            $(document).ready(function(){
                $('#class7').click(function(){
                    $('#class7sub').css("display","block");
                    $('#class6sub').css("display","none");
                    $('#class8sub').css("display","none");
                });
            });
            $(document).ready(function(){
                $('#class8').click(function(){
                    $('#class8sub').css("display","block");
                    $('#class7sub').css("display","none");
                    $('#class6sub').css("display","none");
                });
            });
            $(document).ready(function(){
                $('#class6Rev').click(function(){
                    $('#class6subRev').css("display","block")
                    $('#class7subRev').css("display","none");
                    $('#class8subRev').css("display","none");
                });
            });
            $(document).ready(function(){
                $('#class7Rev').click(function(){
                    $('#class7subRev').css("display","block");
                    $('#class6subRev').css("display","none");
                    $('#class8subRev').css("display","none");
                });
            });
            $(document).ready(function(){
                $('#class8Rev').click(function(){
                    $('#class8subRev').css("display","block");
                    $('#class7subRev').css("display","none");
                    $('#class6subRev').css("display","none");
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
</head><!--/head-->

<body>
<div id="container" ng-app="">
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
   	