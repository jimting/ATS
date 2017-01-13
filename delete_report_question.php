<?php
	session_start();
	include ("mysqli_connect.inc.php");
	$report_question_ID = $_GET['report_question_ID'];
	$sql = "DELETE FROM report_question WHERE report_question_ID = '$report_question_ID'";
	if(mysqli_query($db,$sql))
	{
		echo "刪除成功！";
		echo '<meta http-equiv=REFRESH CONTENT=2;url=report_manage.php>';
	}
	else
	{
		echo "刪除失敗！";
		echo '<meta http-equiv=REFRESH CONTENT=2;url=report_manage.php>';
	}
?>