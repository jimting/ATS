<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$user_ID = $_SESSION['user_ID'];
$post_ID = $_GET['post_ID'];
$report_title = $_POST['report_title'];
$report_comments = $_POST['report_comments'];
$sql = "insert into report_test (post_ID,user_ID, report_title, report_comments) values ('$post_ID','$user_ID', '$report_title', '$report_comments')";
if(mysqli_query($db,$sql))
{
    echo '檢舉成功!';
    echo '	<SCRIPT language=javascript>
			function go()
			{
			window.history.go(-1);
			}
			setTimeout("go()",3000);
			</SCRIPT>';
}
else
{
    echo '檢舉失敗!';
    echo '	<SCRIPT language=javascript>
			function go()
			{
			window.history.go(-1);
			}
			setTimeout("go()",3000);
			</SCRIPT>';
}
?>