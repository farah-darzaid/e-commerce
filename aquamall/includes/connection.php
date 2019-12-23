<?php 
	//open connection
	include("config.php");
 	$conn = mysqli_connect(DBSERVER,DBUSER,DBPASS,DBNAME);
		 //check the connection 
		 if (!$conn){
		 	die("connot connect to server");
		 }
