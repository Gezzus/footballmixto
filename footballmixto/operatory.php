<?php

include("connect.php");
session_start();

#$task_retrieve = "SELECT * FROM Football WHERE id='$_POST['id']'";
#$task_query_retrieve = mysqli_query($link,$task_retrieve);
#$task_query_row = mysqli_fetch_assoc($task_query_retrieve);
#$tasks_query_ammount = mysqli_num_rows($task_query_retrieve);

$task_modify = "UPDATE Football SET team='".$_POST['team']."' WHERE id='".$_POST['id']."'";
#echo $task_modify;
$task_query_modify = mysqli_query($link,$task_modify);
#echo mysqli_error($link);
header("location:index.php");

?>