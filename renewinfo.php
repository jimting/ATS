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
<?php session_start(); ?>
		<div class="container ">
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
<?php
include("mysql_connect.inc.php");

if($_SESSION['user_ID'] != null)
{
        $id = $_SESSION['user_ID'];
        $sql = "SELECT * FROM user where user_ID='$id'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
?>
				<form name="form" method="post" action="update_finish.php" >
				
				<label for="fname">您的名稱</label>
					<input type="text"  name="id" placeholder="<?php echo "$row[1]" ?>" disabled>
				
			
					
					<label for="lname">您的密碼</label></br>
					<input type="password" name="pw"   ></br>
					
					<label for="lname">請再輸入一次密碼</label></br>
					<input type="password" name="pw2"  ></br>
					
					<label for="country">您的科系</label>
					<input type="text" name="department" value="<?php echo "$row[3]"; ?>">
				  
					<input type="submit" value="確認修改">	
				</form>
<?php
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
			</div>
		</div>
	</body>
</html>
