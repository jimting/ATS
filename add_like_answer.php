<?php
	session_start();
	include("mysqli_connect.inc.php");
	$answer_ID=$_POST['answer_ID'];
	$user_ID=$_SESSION['user_ID'];
	$sql = "insert into like_answer(answer_ID ,user_ID) value('$answer_ID','$user_ID')";	
	mysqli_query($db,$sql);
?>