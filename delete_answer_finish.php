<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php"); 
$id = $_SESSION['user_ID'];
$answerID = $_GET['aID'];    //atime包含在網址裡

if($_SESSION['user_ID'] != null)
{
       
        $sql = "delete from answer where user_ID='$id' and answer_ID='$answerID'"; 
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