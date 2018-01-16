<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/api/UserAPI.php";

if(isset( $_POST['username'] ) && isset( $_POST['password']) ) {
     $user = UserAPI::login($_POST['username'], $_POST['password']);
     echo $user;
}

?>
