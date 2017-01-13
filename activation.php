<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include("mysql_connect.inc.php");
	$id = $_GET['id'];
	$pw = $_GET['pw'];
	if(!empty($id) && !is_null($id)){
		$sql = "SELECT * FROM user where user_name = '$id'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw){
			$upact = mysql_query("update user set active = 1 where user_name = '$id'");//修改active啟動帳號
			if($upact > 0){
				$_SESSION['user_ID'] = $row[0];
				echo"<script>alert('帳號啟動成功,系統將跳到首頁');window.location.href='index.html';</script>";
			}
			else{
				echo"<script>alert('帳號啟動失敗1');window.location.href='login.html';</script>";
			}
		}
		else{
			echo"<script>alert('帳號啟動失敗2');window.location.href='login.html';</script>";
		}
	}
	else{
			echo"<script>alert('帳號啟動失敗3');window.location.href='login.html';</script>";
		}
	


?>