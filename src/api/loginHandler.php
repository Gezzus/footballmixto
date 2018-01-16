<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/api/UserService.php";

if(isset( $_POST['username'] ) && isset( $_POST['password']) ) {

     $user = UserService::login($_POST['username'],$_POST['password']); 
     echo $user;
}

?>
