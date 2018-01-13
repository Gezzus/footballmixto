<?php

require_once 'UserService.php';

if(isset( $_POST['username'] )) {
     $user = new User();
     $result = $user->test();

     $user = UserService::login($data);

     $result = [
         "userName" => $user->getUserName(),
         "userName" => $user->getUserName(),

     ];
     echo $user->toJson();
}

?>