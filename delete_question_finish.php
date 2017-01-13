<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php"); 
$id = $_SESSION['user_ID'];
$qid = $_GET['QID'];
if($_SESSION['user_ID'] != null)
{
       
        $sql = "delete from question where user_ID='$id' and question_ID='$qid'"; //比對發文者和發文時間刪除資料庫資料
		$sql2 = "delete from answer where question_ID='$qid'"; 
        if(mysql_query($sql) && mysql_query($sql2))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=userinfo.php>';
        }
        else
        {
                echo '刪除失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=userinfo.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>