<?php session_start(); ?>
<?php
$conn = mysql_connect("127.0.0.1", "root","") or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db("ats");
@$user_ID=$_SESSION['user_ID'];
@$question_name=$_POST['question_name'];
@$question_Title=$_POST['question_Title'];
@$question_depart=$_POST['question_depart'];
@$question_subject=$_POST['question_subject'];
@$question_year=$_POST['question_year'];
@$question_Teacher=$_POST['question_Teacher'];
@$question_context=$_POST['question_context'];
$question_Time = date("Y:m:d H:i:s",time()+25200);

if(isset($question_Title)){
mysql_query("insert into question value('$user_ID','','$question_name','$question_Title','$question_depart','$question_subject','$question_Teacher','$question_context','$question_year','$question_Time','')");
header("Location:question.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>嗨！考啥？-我要發問</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="Style.css">
		<link rel="stylesheet" href="upload.css">
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
						<li class="active"><a href="question.php">問答時間</a></li>
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
		<div class="jumbotron text-center">
			<img src="./image/QandA.png" width="100%"/>
		</div>
		<div class="uicontent">
			<br>
			<form method="post" action="" class="ccform">
				<div class="ccfield-prepend">
				<label for="filter">暱稱</label>
					<input class="ccformfield" type="text" placeholder="暱稱" name="question_name" id="question_name"required>
				</div>
				<div class="form-group  display: inline-block">
					<label for="filter">科系</label>
                                    <select class="form-control" name = "question_depart" id="question_depart">
                                        
                    <option value="商船學系">商船學系</option>
                    <option value="航運管理學系">航運管理學系</option>
                    <option value="運輸科學系">運輸科學系</option>
                    <option value="輪機工程學系">輪機工程學系</option>
                    <option value="海洋經營理學士學位學程(系)">海洋經營理學士學位學程(系)</option>
                    <option value="食品科學系">食品科學系</option>
                    <option value="水產養殖學系">水產養殖學系</option>
                    <option value="海洋生物研究所">海洋生物研究所</option>
                    <option value="生命科學暨生物科技學系">生命科學暨生物科技學系</option>
                    <option value="海洋生物科技博士學位學程">海洋生物科技博士學位學程</option> 
                    <option value="海洋環境資訊系">海洋環境資訊系</option>
                    <option value="環境生物與漁業科學學系">環境生物與漁業科學學系</option>
                    <option value="地科科學研究所">地科科學研究所</option>
                    <option value="海洋事務與資源管理研究所">海洋事務與資源管理研究所</option>
                    <option value="海洋環境與生態研究所">海洋環境與生態研究所</option>
                    <option value="海洋資源與環境變遷博士學位學程">海洋資源與環境變遷博士學位學程</option>
                    <option value="系統工程暨造船學系">系統工程暨造船學系</option>
                    <option value="河海工程學系">河海工程學系</option>
                    <option value="材料工程研究所">材料工程研究所</option>
                    <option value="機械與機電工程學系">機械與機電工程學系</option>
                    <option value="海洋工程科技博士學位學程">海洋工程科技博士學位學程</option> 
                    <option value="電機工程學系">電機工程學系</option>
                    <option value="資訊工程學系">資訊工程學系</option>
                    <option value="通訊與導航工程學系">通訊與導航工程學系</option>
                    <option value="光電科學研究所">光電科學研究所</option>
                    <option value="光電與材料科技學士學位學程(系)">光電與材料科技學士學位學程(系)</option>
                    <option value="教育研究所/師資培育中心">教育研究所/師資培育中心</option>
                    <option value="應用經濟研究所">應用經濟研究所</option>
                    <option value="海洋文化研究所">海洋文化研究所</option>
                    <option value="海洋文創設計產業學位學程(系)">海洋文創設計產業學位學程(系)</option>
                    <option value="海洋法律研究所">海洋法律研究所</option>
                    <option value="海洋觀光管理學士學位學程(系)">海洋觀光管理學士學位學程(系)</option>
                    <option value="海洋法政學士學位學程(系)">海洋法政學士學位學程(系)</option> 
                                    </select>
				</div>
				<div class="ccfield-prepend">
					<label for="filter">標題</label>
					<input class="ccformfield" type="text" placeholder="標題" name="question_Title" id="question_Title"required>
				</div>
				<div class="ccfield-prepend">
					<label for="filter">科目</label>
					<input class="ccformfield" type="text" placeholder="請輸入科目" name="question_subject" id="question_subject"required>
				</div>
				<div class="form-group  display: inline-block">
                                    <label for="contain">年度</label>
                                    <select class="ccformfield" name="question_year">
							
                    <option value="100">100</option>
                    <option value="101">101</option>
                    <option value="102">102</option>
                    <option value="103">103</option>
                    <option value="104">104</option>
                    <option value="105">105</option>
                    <option value="106">106</option>    
                  </select>
                                  </div>
				<div class="ccfield-prepend">
					<label for="filter">老師姓名</label>
					<input class="ccformfield" type="text" placeholder="請輸入老師" name="question_Teacher" id="question_Teacher"required>
				</div>
				<div class="ccfield-prepend">
					<label for="filter">問題內文</label>
					<textarea class="ccformfield" rows="8" placeholder="想問什麼呢..." name="question_context" id="question_context"required></textarea>
				</div>
				<div class="ccfield-prepend">
					<input class="ccbtn" type="submit" value="我要發問">
				</div>
			</form>
		</div>
	</body>
</html>