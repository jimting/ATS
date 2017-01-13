<?php session_start(); ?>
<?php 
$conn = mysql_connect("127.0.0.1", "root","") or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db("ats");
@$question_ID=$_GET['question_ID'];
$data =mysql_query("select * from question where question_ID = '$question_ID' ");
$data2=mysql_query("select * from answer where question_ID = '$question_ID' order by answer_Time asc");//讓資料由最新呈現到最舊
?>

<?php

$conn = mysql_connect("127.0.0.1", "root","") or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db("answer&question");
@$user_ID=$_SESSION['user_ID'];
@$question_ID=$_GET['question_ID'];
@$answerName=$_POST['answerName'];
@$answerTitle=$_POST['answerTitle'];
@$answerContent=$_POST['answerContent'];
$answerTime = date("Y:m:d H:i:s",time()+25200);
$data =mysql_query("select * from question where question_ID = '$question_ID' ");

if(isset($answerName)){
mysql_query("insert into answer value('$user_ID','$question_ID','','$answerContent','$answerTime','$answerName','')");
header("Location:answer_question.php?question_ID=$question_ID");
}
?>

<?php
	include("mysqli_connect.inc.php");
	$question_ID = $_GET['question_ID'];
	$user_ID=$_SESSION['user_ID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>嗨！考啥？</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>
			//這邊是用來判斷問題的讚術語按讚狀態的型態變數
			var bool;
			var like;
			//問題的ID與使用者ID，ajax時會用到
			var question_ID;
			var user_ID;
			//下面是用來判斷回答的讚數與按讚狀態的型態變數
			var answer_max;//總共幾筆answer
			var answer_number = []; //儲存按照順序下來的answer的個別answer_ID
			var answer_bool = [];
			var answer_like = [];
			<?php
				$bool=0;
				$like = 0;//讚數
				$question_ID = $_GET['question_ID'];
				$data3 = "SELECT COUNT(*) as total FROM like_question where question_ID = '$question_ID' ";
				if($stmt = mysqli_query($db ,$data3))
				{
					$result = mysqli_fetch_object($stmt);
					$like = $result->total; //拿到讚數了 NICE
				}
				//確認此user是否按過讚
				$data3 = "SELECT * FROM like_question where question_ID = '$question_ID' ";
				if($stmt = mysqli_query($db,$data3))
				{
						while($result = mysqli_fetch_object($stmt))
						{
								if($result->user_ID ==$user_ID)	
									$bool=1;
						}
				}
				
				//再來要拿到answer的狀態與讚，加上最高的answer_ID號
				$sql = "select * from answer where question_ID = '$question_ID'";
				$answer_number_temp = 0;
				if($stmt=$db->query($sql))
				{
					while($result=mysqli_fetch_object($stmt))
					{
						$answer_ID = $result->answer_ID;
						//儲存answer_number
						echo "answer_number[".$answer_number_temp."] = ".$result->answer_ID.";";
						$sql2 = "SELECT COUNT(*) as total FROM like_answer where answer_ID = '$answer_ID'";
						if($stmt2 = $db->query($sql2))
						{
							$result2 = mysqli_fetch_object($stmt2);
							//儲存此筆answer的like
							echo "answer_like[".$answer_number_temp."] = ".$result2->total.";";
						}
						$sql3 = "SELECT * FROM like_answer WHERE answer_ID = '$answer_ID'";
						//設定此筆answer的狀態
						echo "answer_bool[".$answer_number_temp."] = 0;"; //預設為沒按讚過
						if($stmt3 = $db->query($sql3))
						{
							while($result3 = mysqli_fetch_object($stmt3))
							{
								if($result3->user_ID == $user_ID) //如果找到相符條件代表他有按過讚
								{
									echo "answer_bool[".$answer_number_temp."] = 1;";						
								}
							}
						}
						
						$answer_number_temp++;
					}
				}
				echo "answer_max = ".$answer_number_temp.";";
				
			?>
			bool = <?php echo $bool; ?>; //更改問題的狀態
			like = <?php echo $like; ?>; //拿到問題的讚數
			question_ID = <?php echo $question_ID; ?>; //拿到questionID
			user_ID = <?php echo $user_ID; ?>; //拿到userID
			
			function start()	//頁面剛Load進來會執行的function
			{
				if(bool ==0)
				{	
					document.getElementById("like").innerHTML = '<span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+like+'</span>';
				}
				if(bool ==1)
				{
					document.getElementById("like").innerHTML = '<span class="returnplus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+like+'</span>';
				}
				for(var i = 0;i < answer_max;i++)
				{
					if(answer_bool[i] ==0)
					{
						document.getElementById("answer"+answer_number[i]).innerHTML = '<span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+answer_like[i]+'</span>';
					}
					if(answer_bool[i] ==1)
					{
						document.getElementById("answer"+answer_number[i]).innerHTML = '<span class="returnplus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+answer_like[i]+'</span>';
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
						$.post('add_like_question.php', {question_ID: question_ID});
						bool = 1;
						CheckLikeNumber();
					}
					else
					{
						$.post('delete_like_question.php', {question_ID: question_ID});
						bool = 0;
						CheckLikeNumber();
					}
				});
			});
			//answer的checklike
			function AnswerCheckLikeNumber(answer_ID)
			{
				var i = answer_number.indexOf(parseInt(answer_ID));
				
				if(answer_bool[i] ==0)
				{	
				
					answer_like[i]-=1;
					
					document.getElementById("answer"+answer_ID).innerHTML = '<span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+answer_like[i]+'</span>';
				}
				if(answer_bool[i] ==1)
				{	
				
					answer_like[i]+=1;
					
					document.getElementById("answer"+answer_ID).innerHTML = '<span class="returnplus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'+answer_like[i]+'</span>';
				}
			}
			//answer的傳值button
			function like_answer(answer_ID) 
			{
				var i = answer_number.indexOf(parseInt(answer_ID));
				if(answer_bool[i] == 0)
				{
					$.post('add_like_answer.php', {answer_ID: answer_ID});
					answer_bool[i] = 1;
					AnswerCheckLikeNumber(answer_ID);
				}
				else
				{
					$.post('delete_like_answer.php', {answer_ID: answer_ID});
					answer_bool[i] = 0;
					AnswerCheckLikeNumber(answer_ID);
				}
			}
			
			window.addEventListener("load", start, false );
		</script>

		<link rel="stylesheet" href="./css/font-awesome.min.css"/>
		<link rel="stylesheet" href="Style.css"/>
		<link rel="stylesheet" href="qanda.css"/>
		<link rel="stylesheet" href="upload.css">
		<link rel="stylesheet" href="answer_question.css"/>
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
	<?php
	for($i=1;$i<=mysql_num_rows($data);$i++){
	$rs=mysql_fetch_assoc($data);
	?>
		<div>
			<div class="col-3 menu">
				<ul>
					<li><?php echo $rs['question_name']?></li>
					<li><?php echo $rs['question_depart']?>	</li>
					<li><?php echo $rs['question_subject']?></li>
				</ul>
			</div>
			<div class="header">
				<h1><?php echo $rs['question_Title']?></h1>
				<p class="date"><?php echo $rs['question_time']?></p>
			</div>

			<div class="row">
				<div class="col-9 article">
					<h1><?php echo $rs['question_context']?></h1>
					
				</div>
				<div class="col-9 buttonregion">
					<button class="button" style='float:right;' data-toggle="modal" data-target="#create_answer"><span>我要回答 </span></button>
					<button class="button" style='vertical-align:left' id= "like"><span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></button>
					<button class="button" style="vertical-align:middle" data-toggle="modal" data-target="#reportquestion"><span>檢舉 </span></button>
					
				</div>
			</div>
		</div>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="reportquestion">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content answerblock">
					<br>
					<form method="post" action="add_report_question.php?question_ID=<?php echo $question_ID;?>" class="ccform">
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
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="create_answer">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content answerblock">
					<br>
					<form method="post" action="" class="ccform">
						<div class="ccfield-prepend">
							<input class="ccformfield" style='border-radius:10px;' type="text" placeholder="暱稱" name="answerName" id="answerName"required>
						</div>
						<div class="ccfield-prepend">
							<textarea name="answerContent" class="ccformfield" style='border-radius:10px;' rows="8" placeholder="回答內容敘述..." id="answerContent" required></textarea>
						</div>
						<div class="ccfield-prepend">
							<input class="ccbtn" type="submit" value="我要回答">
						</div>
					</form>
				</div>
			</div>
		</div>
<?php } ?>
	
		<div class="segment col-12">來看看同學們怎麼回覆樓主的問題</div>
		<div>
<?php
for($i=1;$i<=mysql_num_rows($data2);$i++){
 $rs=mysql_fetch_assoc($data2);
?>
			<div class="row">
				<div class="col-9 article">
					<div class="col-12 answerinfo">
						<ul>
							<li><?php echo $i?>樓</li>
							<li><?php echo $rs['answer_name']?></li>
							<li><?php echo $rs['answer_time']?></li>
							
						</ul>
					</div>
					<div  class="answer">
						<p><?php echo $rs['answer_context']?></p>
					</div>
					
				</div>	
				<div class="col-9 buttonregion">
					<button  class="button" onclick ="like_answer('<?php echo $rs['answer_ID']?>')" id= "answer<?php echo $rs['answer_ID']?>"><span class="plus"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span></button>
					<button class="button" style="vertical-align:middle" data-toggle="modal" data-target="#<?php echo $rs['answer_ID']?>"><span>檢舉 </span></button>
				</div>
			</div>
		</div>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="<?php echo $rs['answer_ID']?>">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content answerblock">
					<br>
					<form method="post" action="add_report_answer.php?answer_ID=<?php echo $rs['answer_ID']?>" class="ccform">
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
<?php } ?>
		
	</body>
</html>