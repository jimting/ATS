<?php
	include "question_connect.php";
	$user_ID = 1;
	$question_ID = 1;
	$question_Title = $_POST["question_Title"];
	$question_depart = $_POST["question_depart"];
	$question_Teacher = $_POST["question_Teacher"];
	$question_context = $_POST["question_context"];
	
	mysql_query("SET NAMES 'UTF8'");
	$sql = "INSERT INTO question values ($user_ID,$question_ID,'$question_Title','$question_depart','$question_Teacher','$question_context')";
	$result = mysql_query($sql) or die(mysql_error());
	
	echo "已送出 請稍等";
	echo '<meta http-equiv=REFRESH CONTENT=3;url=uploadQandA.php>'
?>