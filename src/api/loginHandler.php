<?php 

	require_once 'UserService.php';

	if(isset( $_POST['username'] ) && isset( $_POST['password']) ) {

		$userService = new UserService();
	    $result = $userService->login($_POST['username'],$_POST['password']);
		echo $result;
		#echo $result;
	}
	else{
		$result = ["code"=>"1", "message" => "Please complete your username and password."];
	 	echo json_encode($result);
	 	#echo $result;
	}

?>