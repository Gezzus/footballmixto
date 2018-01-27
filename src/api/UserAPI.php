<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/User.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class UserAPI {
	
    public static function register($userName, $password, $nickName, $genderId, $skillId) {
        $user = User::createUser($userName, $password, $nickName, $genderId, $skillId);
        if(($user != null) && (null != ($user->getId()))) {
            if(Session::create($user->getId())) {
                return json_encode(["status" => "success"]);
            } else {
                return json_encode(["status" => "500"]);
            }
        } else {
            return json_encode(["status" => "failed"]);
		}
	}

	public static function login($userName,$password) {
		$user = User::getUser($userName, $password);
		if(($user != null) && (null !== ($user->getId()))) {
		    $session = Session::create($user->getId());
		    if($session) {
		        #var_dump($session);
		        return json_encode(["status" => "success"]);
		    } else {
		       return json_encode(["status" => "500"]);
		    }
		} else {
		    return json_encode(["status" => "failed"]);
		}
	}

}


?>
