<?php

	$db_address = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "avasports";

	#function connect($db_address,$db_user,$db_pass,$db_name)
	$mysqli = new mysqli($db_address,$db_user,$db_pass,$db_name);
	if($mysqli->connect_errno){
		$response["status"]["error"] = ["505",$mysqli->connect_error];
	}

?>