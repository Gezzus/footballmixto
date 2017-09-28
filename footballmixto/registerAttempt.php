<?php
include("connect.php");


$user_name = $_POST["username"];
$user_password = $_POST["password"];

if($user_name == "")
{
	header("location:register.php?id=1");
}

$user_query_create = "INSERT INTO Credentials(username,password) VALUES('".$user_name."',MD5('".$user_password."'))";
$user_query_exists = "SELECT username FROM Credentials WHERE username='".$user_name."'";

$result = mysqli_query($link,$user_query_exists);

	if(mysqli_num_rows($result) == 0){
			if(mysqli_query($link,$user_query_create)){
				$user_id = mysqli_insert_id($link);
				mysqli_query($link,"UPDATE Credentials SET last_login=NOW() WHERE id=".$user_id)."'";
				session_start();
				$_SESSION['id'] = $user_id;
				$_SESSION['username'] = $user_name;
				header("location:index.php");
			}else{
  			header("location:register.php?id=2");
 			}
 	}
	else{
		header("location:register.php?id=1");
	}
?>