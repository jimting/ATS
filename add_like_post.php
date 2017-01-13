<?php
	session_start();
	include("mysqli_connect.inc.php");
	$post_ID=$_POST['post_ID'];
	$user_ID=$_SESSION['user_ID'];
	$sql = "insert into like_post(post_ID ,user_ID) value('$post_ID','$user_ID')";	
	mysqli_query($db,$sql);
?>