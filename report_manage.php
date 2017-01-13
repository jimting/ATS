<!DOCTYPE html>
<html>
	<head>
		<title>嗨！考啥？</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="report_manage.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="report_manage.js"></script>
		<link rel="stylesheet" href="userinfo.css"/>
		<link rel="stylesheet" href="Style.css">
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
						<li class="active"><a href="index.html">Home</a></li>
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
		<h1>檢舉管理</h1>
		<div id="abgne-block-20120327">
			<ul class="tabs">
				<li><span>考古檢舉</span></li>
				<li><span>筆記檢舉</span></li>
				<li><span>問題檢舉</span></li>
				<li><span>回答檢舉</span></li>
			</ul>
			<div class="tab_container">
				<ul class="tab_content">
					<li>          
						<table class="table table-hover">
							<thead>
							  <tr>
								<th>檢舉編號</th>
								<th>考古編號</th>
								<th>檢舉人</th>
								<th>檢舉原因</th>
								<th>檢舉內容</th>
								<th> </th>
								<th> </th>
							  </tr>
							</thead>
							<tbody>
								<?php
									include("mysqli_connect.inc.php");
									$query = 'SELECT * FROM report_test';
									if($stmt = $db->query($query))
									{
										while($result=mysqli_fetch_object($stmt))
										{	
											echo "<tr>";
											echo "<td>".$result->report_test_ID."</td>";
											echo "<td>".$result->post_ID."</td>";
											echo "<td>".$result->user_ID."</td>";
											echo "<td>".$result->report_title."</td>";
											echo "<td>".$result->report_comments."</td>";
											echo "<td><a href='delete_report_test.php?report_test_ID=".$result->report_test_ID."' class='button2' style='vertical-align:middle'><span>刪除檢舉 </span></a></td>";
											echo "<td><a href='articletest.php?post_ID=".$result->post_ID."' class='button2' style='vertical-align:middle'><span>查看貼文 </span></a><a href='admin_delete_test.php?post_ID=".$result->post_ID."' class='button2' style='vertical-align:middle'><span>刪除貼文 </span></a></td>";
											echo "</tr>";
										}
									}
								?>
							</tbody>
						</table>
					</li>
					<li>      
						<table class="table table-hover">
							<thead>
							  <tr>
								<th>檢舉編號</th>
								<th>筆記編號</th>
								<th>檢舉人</th>
								<th>檢舉原因</th>
								<th>檢舉內容</th>
								<th></th>
								<th></th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$query = 'SELECT * FROM report_note';
									if($stmt = $db->query($query))
									{
										while($result=mysqli_fetch_object($stmt))
										{	
											echo "<tr>";
											echo "<td>".$result->report_note_ID."</td>";
											echo "<td>".$result->post_ID."</td>";
											echo "<td>".$result->user_ID."</td>";
											echo "<td>".$result->report_title."</td>";
											echo "<td>".$result->report_comments."</td>";
											echo "<td><a href='delete_report_note.php?report_note_ID=".$result->report_note_ID."' class='button2' style='vertical-align:middle'><span>刪除檢舉 </span></a></td>";
											echo "<td><a href='articlenote.php?post_ID=".$result->post_ID."' class='button2' style='vertical-align:middle'><span>查看貼文 </span></a><a href='' class='button2' style='vertical-align:middle'><span>刪除貼文 </span></a></td>";
											echo "</tr>";						
										}
									}
								?>
							</tbody>
						</table>
					</li>
					<li>      
						<table class="table table-hover">
							<thead>
							  <tr>
								<th>檢舉編號</th>
								<th>問題編號</th>
								<th>檢舉人</th>
								<th>檢舉原因</th>
								<th>檢舉內容</th>
								<th> </th>
								<th></th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$query = 'SELECT * FROM report_question';
									if($stmt = $db->query($query))
									{
										while($result=mysqli_fetch_object($stmt))
										{	
											echo "<tr>";
											echo "<td>".$result->report_question_ID."</td>";
											echo "<td>".$result->question_ID."</td>";
											echo "<td>".$result->user_ID."</td>";
											echo "<td>".$result->report_title."</td>";
											echo "<td>".$result->report_comments."</td>";
											echo "<td><a href='delete_report_question.php?report_question_ID=".$result->report_question_ID."' class='button2' style='vertical-align:middle'><span>刪除檢舉 </span></a></td>";
											echo "<td><a href='answer_question.php?question_ID=".$result->question_ID."' class='button2' style='vertical-align:middle'><span>查看貼文 </span></a><a href='' class='button2' style='vertical-align:middle'><span>刪除貼文 </span></a></td>";
											echo "</tr>";						
										}
									}
								?>
							</tbody>
						</table>
					</li>
					<li>      
						<table class="table table-hover">
							<thead>
							  <tr>
								<th>檢舉編號</th>
								<th>回答編號</th>
								<th>檢舉人</th>
								<th>檢舉原因</th>
								<th>檢舉內容</th>
								<th> </th>
								<th></th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$query = 'SELECT * FROM report_answer';
									if($stmt = $db->query($query))
									{
										while($result=mysqli_fetch_object($stmt))
										{	
											$sql = "SELECT * FROM answer WHERE answer_ID = '$result->answer_ID'";
											
											echo "<tr>";
											echo "<td>".$result->report_answer_ID."</td>";
											echo "<td>".$result->answer_ID."</td>";
											echo "<td>".$result->user_ID."</td>";
											echo "<td>".$result->report_title."</td>";
											echo "<td>".$result->report_comments."</td>";
											echo "<td><a href='delete_report_answer.php?report_answer_ID=".$result->report_answer_ID."' class='button2' style='vertical-align:middle'><span>刪除檢舉 </span></a></td>";
											if($stmt2 = $db->query($sql))
												if($result2 = mysqli_fetch_object($stmt2))
												{
													echo "<td><a href='answer_question.php?question_ID=".$result2->question_ID."&#answer".$result->answer_ID."' class='button2' style='vertical-align:middle'><span>查看貼文 </span></a><a href='admin_delete_answer.php?answer_ID=".$result->answer_ID."' class='button2' style='vertical-align:middle'><span>刪除貼文 </span></a></td>";
												}
											echo "</tr>";				
										}
									}
								?>
							</tbody>
						</table>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
