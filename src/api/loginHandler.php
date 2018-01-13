<?php 

require_once 'User.php';

if(isset( $_POST['username'] )) {
     $user = new User();
     $result = $user->test();
     echo $result;
}

?>