<!DOCTYPE html>
<html>
	<head>
		<title>嗨！考啥？</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="Style.css"/>
		<link rel="stylesheet" href="userinfo.css"/>
		<img src="./image/heart.gif" height="50px" width="100%" />
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="index.html">嗨！考啥？</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="index.html">Home</a></li>
						<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">練功區<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="note.php">看筆記</a></li>
							<li><a href="test.php">看考古</a></li>
						</ul>
						</li>
						<li><a href="question.php">問答時間</a></li>
						<li>
							<a href='logout.php'>登出</a>
						</li>
						<li>
							<iframe src="headerinfo.php" width="200px" height="50px" frameborder="0" scrolling="no"></iframe>
						</li>
					</ul>
				</div>
		  </div>
		</nav>
	</head>
	<body>
		<div class="container">
				<div class="row">
			<h1>您好！</h1>
			<a href="renewinfo.php" class="button col-md-2">修改資訊</a>
			<a href="delete_test.php" class="button col-md-2">管理考古</a>
			<a href="delete_question.php" class="button col-md-2">管理問題</a>
			<a href="delete_note.php" class="button col-md-2">管理筆記</a>
			<a href="delete_answer.php" class="button col-md-2">管理回答</a>
			<a href="delete_question.php" class="button col-md-2">管理發問</a>
		</div>
			<div>
				<table>
<?php session_start(); ?>
<?php
include("mysql_connect.inc.php");

$id = $_SESSION['user_ID'];
if($_SESSION['user_ID'] != null)
{
	echo "<h1>回答的貼文<br>";
	if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }

		if($page)
		{
			$psize=5; //每頁顯示五筆資料
			$sql2 = "select count(*) as total from answer where user_ID='$id'";//尋找此帳號的所有帖子
			$result2 = mysql_query($sql2);
			
			if($result2 > 0){
				$dcount = mysql_result($result2,0);       //總資料數
				$pcount = ceil($dcount/$psize);                 //總頁數
				$offset = ($page-1)*$psize;
				$sql3 = "select * from answer where user_ID='$id' order by answer_time desc limit $offset,$psize";
				$result3 = mysql_query($sql3);
			
?>
<table>
	<tr>
		<th>標題</th>
		<th>日期</th>
		<th> </th>
	</tr>
<?php
				while ($row = mysql_fetch_array($result3))           //輸出資料內容
				{
					$context=$row['answer_context'];
					$time=$row['answer_time'];					//*不知道下一行是否要設帖子的超連結????*
					$answerID=$row['answer_ID'];
?>
<tr>
    <td><?php echo mb_strimwidth($context,0,15,"...","UTF-8"); ?></td> 
	<td><?php echo $time; ?></td>
	<td align="center">
		<form action="delete_answer_finish.php?aID=<?php echo $answerID;?>" method="post" name="form1">
				<button class="button2" style="vertical-align:middle"><span>刪除貼文 </span></button>
		</form>
		<form action="answer_question.php?question_ID=<?php echo $row['question_ID'];?>"  method="post" name="form2">
				<button class="button2" style="vertical-align:middle" ><span>查看貼文 </span></button>
		</form>
	</td>
</tr>
<?php 
				}
?>
</table>
<br />
<?php
				echo '<p>記錄:共 '.$dcount.' 筆 頁次: '.$page.' / '.$pcount.' 頁'; //分頁操作
				echo "<br /><a href=?page=1>首頁</a> ";
				echo "第<strong> ";
				for( $i=1 ; $i<=$pcount ; $i++ ) {
					if ( $page-3 < $i && $i < $page+3 ) {
						echo "<a href=?page=".$i.">".$i."</a> ";
					}
				} 
				echo " </strong>頁 <a href=?page=".$pcount.">末頁</p>";	
					
					}
					else{
						echo'無貼文';
					
					}
			
		}
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}		
?>
				</table>
			</div>
		</div>
	</body>
</html>
