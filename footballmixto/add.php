<?php

include("../Conectarse.php");

$task_add = "INSERT INTO Football(name,skill,sex,schedule,team) VALUES('".$_POST['name']."','".$_POST['skill']."','".$_POST['sex']."','".$_POST['schedule']."','0')";

echo $task_add;
mysqli_query($link,$task_add);
echo mysqli_error($link);
header("location:../testingfootball.php");
	
?>