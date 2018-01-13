<?php

#require_once '../model/User.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class UserService{

	
	public function register(){

		#mocked reply from $user = new User;
		#$response $user->create($data arguments);

		#$result = ["id" => "1","message"=>"Successful login","code" => 200]; #TestResult
		
		$result = ["message"=>"Register failed","code" => 0]; #TestResult
		
		if($result["code"] == 200){
			    session_start();
			    $_SESSION['id'] = $result['id'];
			}

		return json_encode($result);	
	}

	public function login($username,$password){
		#$user = new User;

		
		#$result = ["id" => "1","message"=>"Successful login","code" => 200]; #TestResult
		
		$result = ["message"=>"Login failed","code" => 0]; #TestResult
		

		if($result["code"] == 200){
			    session_start();
			    $_SESSION['id'] = $result['id'];
			}

	    #echo $result;
			#print_r($result);
		# TODO: $result = $user->retrieveUserDb($username,$password);
		return json_encode($result);
	}

	/*public function create(){
		#$user = new User;
		$result = $user->createUserDb($username,$password);
		return $result;			
	}*/

	public function logout(){
		session_destroy();
	}

	



}


?>