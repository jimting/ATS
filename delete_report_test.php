<?php
	session_start();
	include ("mysqli_connect.inc.php");
	$report_test_ID = $_GET['report_test_ID'];
	$sql = "DELETE FROM report_test WHERE report_test_ID = '$report_test_ID'";
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