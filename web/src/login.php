<?php

include("connect.php");
session_start();

$received_username =  filter_var($_POST["username"],FILTER_SANITIZE_STRING);
$received_password  = filter_var($_POST["password"],FILTER_SANITIZE_STRING);


$user_query_locate = "SELECT user.id as 'user.id', user.username as 'user.username',player.nickName as 'player.nickName' FROM user LEFT JOIN player ON player.id = user.playerId WHERE userName='".$received_username."' AND password=MD5('".$received_password."')";
$user_query_locate_result = mysqli_query($link,$user_query_locate);

	$user_query_locate_row = mysqli_fetch_assoc($user_query_locate_result);
	if(mysqli_num_rows($user_query_locate_result) == 0){
		header("location:../login.php?id=1");
	}
	else{
		$_SESSION['id'] = $user_query_locate_row["user.id"];
		$_SESSION['username'] = $user_query_locate_row["user.username"];
		$_SESSION['nickname'] = $user_query_locate_row["player.nickName"];
		mysqli_query($link,"UPDATE user SET lastLogin=NOW() WHERE id=".$user_query_locate_row["id"]);
		#echo $_SESSION['id']."  -  ".$_SESSION['username']."   -".
		header("location:../index.php");
	}

	
?>

