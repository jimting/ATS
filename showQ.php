<?php
	include "question_connect.php";
	
	$query = "SELECT * FROM question";
	$result = mysql_query($query);
	mysql_query("SET NAMES 'UTF8'");
	if($stmt = $db->query($query)){
		while($result=mysqli_fetch_object($stmt))
		{
			echo "<tr>";
			echo "<td>".$result->question_Title."</td>";
			echo "<td>".$result->question_depart."</td>";
			echo "<td>".$result->question_Teacher."</td>";
			echo "<td>".$result->question_context."</td>";
			echo "</tr>";
			//$question_ID += 1;
		}
	}
?>