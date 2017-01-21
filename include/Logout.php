<?php
require_once('connection.php');
ob_start();
session_start();
$user= $_SESSION['Id'];
mysqli_query($con,"CALL sp_updateRevisedQuestionsCheck('$user')");
session_destroy(); 
header("Location:../index.php")
?>
