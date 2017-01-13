<?php
	session_start();
	include("mysqli_connect.inc.php");
	$question_ID=$_POST['question_ID'];
	$user_ID=$_SESSION['user_ID'];
	$sql = "insert into like_question(question_ID ,user_ID) value('$question_ID','$user_ID')";	
	mysqli_query($db,$sql);
?>