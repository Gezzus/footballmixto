<?php
	include("Conectarse.php");
	session_start();

$user_name = $_POST["username"];
$user_password = $_POST["password"];
#$pass = "SELECT MD5(password) FROM Credentials WHERE MATCH('username') AGAINST($candidateName)";-
$u = "SELECT * FROM Credentials WHERE username='".$user_name."' AND password=MD5('".$user_password."')";
$result = mysqli_query($link,$u);

	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result) == 0){
		header("location:login.php?id=1");
	}
	else{
		$_SESSION['id'] = $row["id"];
		$_SESSION['username'] = $row["username"];
		mysqli_query($link,"UPDATE Credentials SET last_login=NOW() WHERE id=".$row["id"]);
		header("location:testingfootball.php");
	}

	
?>