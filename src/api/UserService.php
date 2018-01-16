<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/User.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class UserService{
	
	public static function register($userName, $password, $nickName, $genderId) {
		if ($newUser = User::createUser($userName, $password, $nickName, $genderId) != null) {
			return $newUser->toJson();
		} else {
			return null;
		}
	}

	public static function login($userName,$password) {
		if ($user = User::getUser($userName, $password)) {
			return $user->toJson();
		} else {
			return null;
		}
	}

	public static function logout(){
		session_destroy();
	}

}


?>
