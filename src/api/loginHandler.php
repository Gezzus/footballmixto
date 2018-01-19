<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/UserAPI.php";

#echo "Username: ".$_POST['username'];
#echo "password: ".$_POST['password'];

if((!(empty($_POST['userName']))) && (!(empty($_POST['password'])))) {

 $user = UserAPI::login($_POST['userName'], $_POST['password']);
 echo $user;
} else {
	echo json_encode(["status" => "empty"]);
}

?>

