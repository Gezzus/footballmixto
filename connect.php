<?php
function connect(){
// LOCAL
$host_db = "localhost";
$usuario_db = "test";
$pass_db = "test";
$base_db = "Users";

if (!($link=mysqli_connect($host_db, $usuario_db, $pass_db)))
	{
	echo "Failed to connect.";
	exit();
	}
if (!mysqli_select_db($link,$base_db))
	{
	echo mysqli_error($link);
	echo "Failed to connect.";
	exit();
	}
  return $link;
}
$link = connect();
?>