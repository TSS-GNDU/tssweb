<?php
	session_start();
	ob_start();
	$host = "localhost";
	$user = "root";
	$password = "";
	$database  = "database";
	
	$name_flag =0;
	$file_flag =0;
	$contact_flag =0;
	$feedback_flag =0;
	
	$file_error ="";
	$name_error ="";
	$contact_error ="";
	$feedback_error ="";
			
	if(!mysql_connect($host , $user , $password) || !mysql_select_db($database)){
		die("cannot submit at this moment");
	}
?>
<html>
	<head>
		<link rel= "stylesheet" type = "text/css"  href="css/semantic.min.css"/>
		<link rel= "stylesheet" type = "text/css"  href="css/feedback1.css"/>
	</head>
</html>