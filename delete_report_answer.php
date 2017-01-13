<?php
	session_start();
	include ("mysqli_connect.inc.php");
	$report_answer_ID = $_GET['report_answer_ID'];
	$sql = "DELETE FROM report_answer WHERE report_answer_ID = '$report_answer_ID'";
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