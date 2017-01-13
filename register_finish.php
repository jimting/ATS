<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$department = $_POST['department'];

$get = "SELECT * FROM user where user_name = '$id'";
$num = mysql_query($get);
$rowa = @mysql_fetch_row($num);
//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
//判斷註冊帳號是否重複
if($id != null && $pw != null && $pw2 != null && $pw == $pw2 && $rowa[1] != $id)
{
	$url = "http://140.121.197.130:8050/www/index.html";
	$url .= '?id='.$id.'&pw='.md5($pw);       //產生URL,網址不確定
	$subject="取得啟動碼";
	$mailbody='registration success。your start up URL is :'.$url;
	$envelope["from"] = "bear_linm8866@yahoo.com.tw";    //寄信位置,信件格式
	$part1["type"] = TYPEMULTIPART;
	$part1["subtype"] = "mixed";
	$part2["type"] = TYPETEXT;
	$part2["subtype"] = "plain";
	$part2["encoding"] = ENCBINARY;
	$part2["contents.data"] = "$mailbody\n\n\n\t";
	$body[1] = $part1;
	$body[2] = $part2;
	$message=imap_mail_compose($envelope, $body);
	list($msgheader,$msgbody)=split("\r\n\r\n",$message,2);
	$email =  $id.'@ntou.edu.tw';
	$sendout=@imap_mail($email,$subject,$msgbody,$msgheader);
	if(false == $sendout or $sendout == ''){
		echo '啟動碼寄送失敗';
		echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
	}
	else{
		$post_time = date("Y:m:d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y')));
        //新增資料進資料庫語法
		$count = "SELECT COUNT(user_name) FROM user WHERE user_name IS NOT NULL";
        $sql = "insert into user (user_ID,user_name, user_pw, user_department, user_createtime) values ('$count','$id', '".md5($pw)."', '$department', '$post_time')";
        if(mysql_query($sql))
        {
                echo '新增成功!請至海大信箱啟動驗證碼';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
        }
        else
        {
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
        }
	}
}
else if($rowa[1] == $id)
{
	echo '此帳號已註冊過，請勿重複註冊';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
}
else
{
        echo '請確認資料填寫正確!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
}
?>