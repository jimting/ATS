<?php
	session_start();
	include ("mysqli_connect.inc.php");
	$report_note_ID = $_GET['report_note_ID'];
	$sql = "DELETE FROM report_note WHERE report_note_ID = '$report_note_ID'";
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