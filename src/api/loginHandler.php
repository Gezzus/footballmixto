<?php

require_once 'UserService.php';

if(isset( $_POST['username'] ) && isset( $_POST['password']) ) {

     $user = UserService::login($data);

     #result = ["code"=>"1", "message" => "Please complete your username and password."];

     $result = [
         "userName" => $user->getUserName(),
         "userName" => $user->getUserName(),
     ];
     echo $result->toJson();
}

?>