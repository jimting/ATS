<?php
	$localhost = 'localhost';
	$user = 'tienyao';
	$password = 'H124706650';
	$database = 'upload';
	$db = mysqli_connect($localhost,$user,$password,$database);
	mysqli_set_charset($db,"utf8");
	mysqli_select_db($db,"upload");
	$data="SELECT * FROM `uploadtest` ORDER BY `uploadtest`.`post_time` DESC";
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
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">嗨！考啥？</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.html">Home</a></li>
        <li class="dropdown">
          <a class="active" data-toggle="dropdown" href="#">練功區<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="note.html">看筆記</a></li>
			<li><a href="test.html">看考古</a></li>
          </ul>
        </li>
        <li><a href="qanda.html">問答時間</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span>註冊</a></li>
		<li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span>登入</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div data-role="main" class="ui-content">
	<div class="form-group">
		<input type="text" class="form" id="search" placeholder="Search for content...">
		<button type="submit" class="btn btn-default">搜尋</button>
	</div>
	<div data-role="main" class="ui-content">
    <h2 class="test-center">今日特餐：<a href="Archaeology.html" class="btn btn-default">上傳考古</a></h2>
	
    <ul data-role="listview" data-inset="true" name="list">    

    <li class="list-group-item list-group-item-warning" style="margin-right: 5%;"><div class="row"><center><div  class="col-xs-2 col-md-2 ">科系</div ><div class="col-xs-2 col-md-1">年分</div ><div class="col-xs-2 col-md-2">科目</div ><div class="col-xs-2 col-md-2">老師</div ><div class="col-xs-2 col-md-2">標題</div ></center><div  class="text-right col-xs-2 col-md-1"><span class="glyphicon glyphicon-thumbs-up">讚數</div><div class="col-xs-2 col-md-2">上傳時間</div ></div></li><br>
	
	<?php
	$sql = mysqli_query($db,"SELECT * FROM uploadtest");
	$post_ID = mysqli_num_rows($sql);
	
	
	
	$color=array("list-group-item-info","list-group-item-success");
	$i=0;
	if($stmt = $db-> query($data)){
		while($result = mysqli_fetch_object($stmt)){
			$i++;
        $j=$i%2;
  			echo ' <li class="list-group-item '.$color[$j].'" style="margin-right: 5%;"><div class="row"><center><div  class="col-xs-2 col-md-2 ">'.$result->depart.'</div ><div class="col-xs-2 col-md-1">'.$result->year.'</div ><div class="col-xs-2 col-md-2">'.$result->teacher.'</div ><div class="col-xs-2 col-md-2">'.$result->subject.'</div ><div class="col-xs-2 col-md-2">'.$result->Title.'</div ></center><div  class="text-right col-xs-2 col-md-1"><span class="glyphicon glyphicon-thumbs-up">0</div><div  class="col-xs-2 col-md-2 ">'.$result->post_time.'</div></div></li><br>';
			
		}
	}
	?>
	  
	
	

      
    </ul>
  </div>
  </div>
</div>  
	</body>
</html>