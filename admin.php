<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="userinfo.css"/>
<?php
include("mysqli_connect.inc.php");
$user_ID = $_SESSION['user_ID'];
$sql = "SELECT user_level FROM user WHERE user_ID = '$user_ID'";
if($stmt = $db->query($sql))
{
	if($result = mysqli_fetch_object($stmt))
	{
		if($result->user_level > 4)
		{
			echo '<a href="report_manage.php" target="_parent" class="button2"><span>檢舉管理</span></a>';
		}
	}
}
?>