<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/User.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class UserAPI{
	
	public static function register($userName, $password, $nickName, $genderId) {
		if ($newUser = User::createUser($userName, $password, $nickName, $genderId) != null) {
			return $newUser->toJson();
		} else {
			return null;
		}
	}

	public static function login($userName,$password) {
		$user = User::getUser($userName, $password);
		#$user = User::getUserWithId(9);
		if($user != null){
			#return $user->toJson();
			return json_encode($user);
		} else { 
			$result = ["status" => "failed1"];
			return json_encode($result);
		}


	}

	public static function logout(){
		session_destroy();
	}

}


?>
