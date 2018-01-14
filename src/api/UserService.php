<?php

require_once '../model/User.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class UserService{

	
	public function register($userName,$password,$nickName,$genderId){

		if($newUser = User::createUser($userName,$password,$nickName,$genderId) != null){
			$result = ["id" => $newUser]; 	
		}else{
			$result = ["message"=>"Creation failed","code" => 0]; 
			return json_encode($result);
		}
	}

	public function login($username,$password){

		$result = ["message"=>"Login failed","code" => 0]; #TestResult
		

		if($result["code"] == 200){
			    session_start();
			    $_SESSION['id'] = $result['id'];
			}
		return json_encode($result);
	}

	public function logout(){
		session_destroy();
	}

	



}


?>