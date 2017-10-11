<?php

include("connect.php");
session_start();


$task_modify = "UPDATE Football SET team='".$_POST['team']."' WHERE id='".$_POST['id']."'";

$task_query_modify = mysqli_query($link,$task_modify);

header("location:index.php");

?>