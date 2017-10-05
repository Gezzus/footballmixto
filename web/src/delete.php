<?php
include("connect.php");
session_start();
	include("menumanager.php");


	if(isAdmin($_SESSION['id'],$link) == '0')
	{
		header("location:index.php");
		echo isAdmin($_SESSION['id'],$link);
	}
	else
	{
		if($_GET['id'] == 'all')
		{
			$task_erase = "TRUNCATE TABLE Football";
			mysqli_query($link,$task_erase);
			echo mysqli_error($link);
			header("location:index.php");
		}
	}
?>
