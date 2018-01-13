<?
#include("connect.php");
session_start();
	
	if($_SESSION['navbar'] == 1)
	{
		$_SESSION['navbar'] = 0;
		header("location:../index.php");
	}
	elseif($_SESSION['navbar'] == 0)
	{
		$_SESSION['navbar'] = 1;

		header("location:../index.php");
	}
	
	elseif(!isset($_SESSION['navbar']))
	{
		$_SESSION['navbar'] = 1;
		header("location:../index.php");
	}

	header("location:../index.php");

?>