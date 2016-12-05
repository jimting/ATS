<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="login.css">
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];

//搜尋資料庫資料
$sql = "SELECT * FROM user where user_name = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['user_name'] = $id;
        echo '<div class="login"><h1>登入成功！<h1><br><h1>冒險即將啟程！</h1></div>';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=index.html>';
}
else
{
        echo '<div class="login"><h1>請再次確認您的帳號密碼是否正確</h1><br><h1>系統將自動轉跳自登入頁！</h1></div>';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=login.html>';
}
?>