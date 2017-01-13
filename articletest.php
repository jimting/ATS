<!DOCTYPE html>
<?php session_start(); ?>
<?php
	include("mysqli_connect.inc.php");
	$post_ID=$_GET['post_ID'];
	$user_ID=$_SESSION['user_ID'];
?>
<html>
	<head>
		<title>嗨！考啥？</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="qanda.css"/>
		<link rel="stylesheet" href="upload.css">
		<link rel="stylesheet" href="answer_question.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>	
			var bool = 0;
			var bool;
			var like;
			var post_ID;
			var user_ID;
			<?php
				$bool=0;
				$like = 0;//讚數
				$post_ID = $_GET['post_ID'];
				$data2 = "SELECT COUNT(*) as total FROM like_test where test_ID = '$post_ID' ";
				if($stmt = mysqli_query($db ,$data2))
				{
					$result = mysqli_fetch_object($stmt);
					$like = $result->total; //拿到讚數了 NICE
				}
				//確認此user是否按過讚
				$data2 = "SELECT * FROM like_test where test_ID = '$post_ID' ";
				if($stmt = mysqli_query($db,$data2)){
						while($result = mysqli_fetch_object($stmt))
						{
								if($result->user_ID ==$user_ID)	
									$bool=1;
						}
				}
				//拿照片
				$picture=array();
					$i=0;
					$j=0;
					$data3 = "SELECT * FROM testimg where post_ID='$post_ID'";
					if($stmt = mysqli_query($db,$data3))
					{
						while($result = mysqli_fetch_object($stmt))
						{
							$picture[$i]=$result->ImageName;
							$i++;
						}
					}
			?>
			bool = <?php echo $bool; ?>; //更改狀態
			like = <?php echo $like; ?>; //拿到讚數
			post_ID = <?php echo $post_ID; ?>; //拿到testID
			user_ID = <?php echo $user_ID; ?>; //拿到userID
			var PictureNumber = <?php echo $i ?>; //拿到圖片總數
			function start()
			{
				if(bool ==0)
				{			
					document.getElementById("like").innerHTML = '<span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+like+'</span>';
				}
				if(bool ==1)
				{
					document.getElementById("like").innerHTML = '<span class="returnplus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+like+'</span>';
				}
				var i=0;
				var a = "<?php echo $picture[0]?>";
				if(a != ""){
			
				while(i< <?php echo $i ;?>){
			
					<?php for($j=0;$j<$i;$j++): ?>
					document.getElementById("picture").innerHTML+= '<img width="50%" height="50%" src="/uploads/<?php echo $picture[$j]; ?>"/>' ;  
					i++;
			
					<?php endfor; ?>
					}
				}
			}	
			function CheckLikeNumber()
			{
				if(bool ==0)
				{	
					like--;
					document.getElementById("like").innerHTML = '<span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+like+'</span>';
				}
				if(bool ==1)
				{
					like++;
					document.getElementById("like").innerHTML = '<span class="returnplus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+like+'</span>';
				}
			}
			$(document).ready(function()
			{
				$("#like").click(function()
				{
					if(bool == 0)
					{
						$.post('add_like_test.php', {post_ID: post_ID});
						bool = 1;
						CheckLikeNumber();
					}
					else
					{
						$.post('delete_like_test.php', {post_ID: post_ID});
						bool = 0;
						CheckLikeNumber();
					}
				});
			});
			window.addEventListener("load", start, false );
		</script>
		<link rel="stylesheet" href="./css/font-awesome.min.css"/>
		<link rel="stylesheet" href="Style.css"/>
		<link rel="stylesheet" href="article.css"/>
		<header>
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
							<a class="active" data-toggle="dropdown" href="#">練功區<span class="caret"></span></a>
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
		</header>
	</head>
	<body>
		<?php 
			$id=$_GET['post_ID'];
			$sql = "SELECT * FROM uploadtest where post_ID='$id'";
			if($stmt = mysqli_query($db,$sql)){
			  $row = mysqli_fetch_object($stmt);
			}
		?>
		<div class="col-3 menu">
			<ul>
				<li><?php echo $row->depart; ?></li>
				<li><?php echo $row->subject; ?></li>
				<li><?php echo $row->teacher;?></li>
			</ul>
		</div>
		<div class="header">
			<h1 align="center"><?php echo $row->Title;?></h1>
			<p class="date" ><?php echo $row->post_time;?></p>
		</div>
		<div class="row">
			<div class="col-9 article">
				<?php echo $row->context ;?>
					<br><br><hr><br><div id = "picture"></div>
			</div>
			<div class="col-9 buttonregion">
				<button class="button" id= "like"><span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></button>
				<button class="button" style="vertical-align:middle" data-toggle="modal" data-target="#reporttest"><span>檢舉 </span></button>
			</div>
		</div>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="reporttest">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content answerblock">
					<br>
					<form method="post" action="add_report_test.php?post_ID=<?php echo $id;?>" class="ccform">
						<div class="ccfield-prepend">
							<div class="ccformfield" style='border-radius:10px;text-align:center;color:black;'><strong>請選擇檢舉原因</strong></div>
							<br>
							<select class="ccformfield" style='border-radius:10px;' name="report_title" required>
								<option>內容空泛</option>
								<option>帶有攻擊他人字眼</option>
								<option>答非所問</option>
								<option>暴力、種族歧視</option>
							</select>
						</div>
						<div class="ccfield-prepend">
							<textarea class="ccformfield" style='border-radius:10px;' name="report_comments" rows="8" placeholder="檢舉內容敘述..." required></textarea>
						</div>
						<div class="ccfield-prepend">
							<button type="submit" class="ccbtn"  >確定檢舉</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
