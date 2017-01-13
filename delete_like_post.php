<?php
	session_start();
	include("mysqli_connect.inc.php");
	$post_ID=$_POST['post_ID'];
	$user_ID=$_SESSION['user_ID'];
	$sql = "delete from like_post where user_ID='$user_ID' AND post_ID='$post_ID'";
	mysqli_query($db,$sql);
?>