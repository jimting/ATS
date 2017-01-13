<?php
	session_start();
	include("mysqli_connect.inc.php");
	$answer_ID=$_POST['answer_ID'];
	$user_ID=$_SESSION['user_ID'];
	$sql = "delete from like_answer where user_ID='$user_ID' AND answer_ID='$answer_ID'";
	mysqli_query($db,$sql);
?>