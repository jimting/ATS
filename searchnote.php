<?php
	$localhost = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'ats';
	$db = mysqli_connect($localhost,$user,$password,$database);
	mysqli_set_charset($db,"utf8");
	mysqli_select_db($db,"ats");
	error_reporting(0);
	$depart  = $_POST["depart"];
	$years  = $_POST["years"];
	$search  = $_POST["search"];
	
	
	
	if($_POST["search"] ==null){
		if($_POST["depart"]<>'all'&&$_POST["years"]<>'all'&& $_POST["depart"]<>null&& $_POST["years"]<>null ){
			$data = "SELECT * FROM uploadnote where ( year = '$years') AND  (depart = '$depart') ORDER BY `uploadnote`.`post_time` DESC";		
		}
		else if($_POST["depart"]<>'all' && $_POST["depart"]<>null){
		$data = "SELECT * FROM uploadnote where (depart = '$depart') ORDER BY `uploadnote`.`post_time` DESC";		
	}
		else if($_POST["years"]<>'all' && $_POST["years"]<>null ){
		$data = "SELECT * FROM uploadnote where  (year = '$years') ORDER BY `uploadnote`.`post_time` DESC";
		
		}	
		else{
			$data="SELECT * FROM `uploadnote` ORDER BY `uploadnote`.`post_time` DESC";
		}
		if($stmt = mysqli_query($db,$data)){
			while($result = mysqli_fetch_object($stmt)){
					$sql2 = mysqli_query($db,'SELECT * FROM like_post where post_ID = '.$result->post_ID);
					$praisenum = mysqli_num_rows($sql2);
					echo '<tr onclick="window.location=\'articlenote.php?post_ID='.$result->post_ID.'\'"><td>'.$result->depart.'</td><td>'.$result->year.'</td><td><strong>'.$result->subject.'</strong></td><td>'.$result->teacher.'</td><td>'.$result->Title.'</td><td>'.$praisenum.'</td><td>'.$result->post_time.'</td></tr></a> ';
			}
		}
		else{ echo "error";}
	}
	else {
		if($_POST["depart"]<>'all'){
		$sql = "SELECT * FROM uploadnote where (teacher like '%$search%' )OR(subject like '%$search%')OR(Title like '%$search%')OR(context like '%$search%')AND(  year = '$years') AND  (depart = '$depart') ORDER BY `uploadnote`.`post_time` DESC";		
	}
		else {
		$sql = "SELECT * FROM uploadnote where (teacher like '%$search%')OR(subject like '%$search%')OR(Title like '%$search%')OR(context like '%$search%') AND  (year = '$years') ORDER BY `uploadnote`.`post_time` DESC";
		
		}		
		if($stmt = mysqli_query($db,$sql))
			{
				while($result = mysqli_fetch_object($stmt)){
				$sql2 = mysqli_query($db,'SELECT * FROM like_post where post_ID = '.$result->post_ID);
					$praisenum = mysqli_num_rows($sql2);
				echo '<tr onclick="window.location=\'articlenote.php?post_ID='.$result->post_ID.'\'"><td>'.$result->depart.'</td><td>'.$result->year.'</td><td><strong>'.$result->subject.'</strong></td><td>'.$result->teacher.'</td><td>'.$result->Title.'</td><td>'.$praisenum.'</td><td>'.$result->post_time.'</td></tr></a> ';
				}
			}
		else{ echo "error";}
	}
	?>