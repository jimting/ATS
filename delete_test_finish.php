<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php"); 
$id = $_SESSION['user_ID'];
$testID = $_GET['tID'];    //ptime包含在網址裡

if($_SESSION['user_ID'] != null)
{
       
        $sql = "delete from uploadtest where user_ID='$id' and post_ID='$testID'"; //比對發文者和發文時間刪除資料庫資料
        if(mysql_query($sql))
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
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
}
?>