<?php

require_once 'UserService.php';

if(isset( $_POST['username'] ) && isset( $_POST['password']) ) {

     $user = UserService::login($_POST['username'],$_POST['password']); 
     echo $user;
}

?>