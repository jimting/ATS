<?php
	$db_server = 'localhost';
	$db_user = 'root';
	$db_passwd = '';
	$db_name = 'ats';
	$db = mysql_connect($db_server, $db_user, $db_passwd);
	
	mysql_set_charset("utf8");//設定編碼
	mysql_select_db("upload"); //連線狀態中更換資料庫
?>