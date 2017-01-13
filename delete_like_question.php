<?php
	session_start();
	include("mysqli_connect.inc.php");
	$question_ID=$_POST['question_ID'];
	$user_ID=$_SESSION['user_ID'];
	$sql = "delete from like_question where user_ID='$user_ID' AND question_ID='$question_ID'";
	mysqli_query($db,$sql);
?>