<?php 
$conn = mysql_connect("127.0.0.1", "root","") or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db("ats");
@$question_depart=$_GET['question_depart'];	
if($question_depart != 'all' && $question_depart != null)
	$data=mysql_query("select * from question where question_depart = '$question_depart' order by question_Time DESC");
else
	$data=mysql_query("select * from question order by question_Time DESC");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>嗨！考啥？</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="Style.css">
		<link rel="stylesheet" href="table.css">
		<link rel="stylesheet" href="search.css"/>
		<link rel="stylesheet" href="./css/font-awesome.min.css"/>
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
			<img src="./image/QandA.png" width="100%" />
		</div>
		<div data-role="main" class="ui-content">
			<div class="col-md-12">
				<div class="input-group" id="adv-search">
				
					
					<div class="input-group-btn">
						<div class="btn-group" role="group">
							<div class="dropdown dropdown-lg">
								<form class="form-horizontal" role="form">
										<div class="form-group">
										<label for="filter">科系</label>
										
											<select class="form-control" name = "question_depart">
												<option value="all" selected>全部</option>
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
										
										<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></div>
									</form>
								
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="create_question.php" class="btn btn-lg btn-default" style="float:right;width:300px"><span class="glyphicon glyphicon-fire"></span> 我要發問</a>
		<table>
				<tr>
					<th>科系</th>
					<th>年分</th>
					<th>科目</th>
					<th>老師</th>
					<th>標題</th>
					<th>上傳時間</th>
					
				</tr>
	<?php
	for($i=1;$i<=mysql_num_rows($data);$i++){
	$rs=mysql_fetch_assoc($data);
	?>
				<tr onClick="window.location.href='answer_question.php?question_ID=<?php echo $rs['question_ID']?>';">
					<td><?php echo $rs['question_depart']?></td>
					<td><?php echo $rs['question_year']?></td>
					<td><strong><?php echo $rs['question_subject']?></strong></td>
					<td><?php echo $rs['question_Teacher']?></td>
					<td><?php echo $rs['question_Title']?></td>
					<td><?php echo $rs['question_time']?></td>
					
				</tr>

	<?php } ?>		
		</table>
	</body>
</html>