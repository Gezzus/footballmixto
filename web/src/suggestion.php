<?php
include("connect.php");
session_start();


$received_suggestion =  filter_var($_POST["content"],FILTER_SANITIZE_STRING);
$received_suggestion_owner = $_SESSION['id'];
$store_suggestion = "INSERT INTO suggestion(content,owner) VALUES('".$received_suggestion."','".$received_suggestion_owner."')";
$query_store_suggestion = mysqli_query($link,$store_suggestion);
mysqli_error($link);
header("location:../index.php");

?>