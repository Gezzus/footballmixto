<?php
session_start();


	function uploadPicture($userId,$pictureFile)
	{
		file_put_contents($_SESSION['id'],file_get_contents($_FILES['image']['tmp_name']));
		header("location:../profile.php");
	}

	





?>