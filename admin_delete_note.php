<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");
$post_ID = $_GET['post_ID'];
$user_ID = $_SESSION['user_ID'];
$sql = "SELECT user_level FROM user WHERE user_ID = '$user_ID'";
if($stmt = $db->query($sql))
{
	if($result = mysqli_fetch_object($stmt))
	{
		if($result->user_level > 4)
		{
				$sql = "delete from uploadnote where post_ID='$post_ID'"; 
				$sql2 = "delete from report_note where post_ID='$post_ID'"; 
				if(mysqli_query($db,$sql) && mysqli_query($db,$sql2))
				{
						echo '刪除成功!';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=report_manage.php>';
				}
				else
				{
						echo '刪除失敗!';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=report_manage.php>';
				}
		}
		else
		{
				echo '您無權限觀看此頁面!';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
		}
	}
}
?>