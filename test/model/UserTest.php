<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "src/model/User.php");
$userName = "TEST";
$password = "1";
$nickName = "ALLBOYS";
$genderId = 1;

echo "<pre>";
$test1 = User::createUser($userName,$password,$nickName,$genderId);
print_r($test1->toJson());

echo "</pre>"
	
?>
