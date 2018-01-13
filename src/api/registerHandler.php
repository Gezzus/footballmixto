<?php 

	require_once 'UserService.php';

	if(isset( $_POST['username'] ) && isset( $_POST['password']) &&
	   isset( $_POST['nickname'] ) && isset( $_POST['gender']) &&
	   isset( $_POST['skill'] ) && isset( $_POST['email']) && ) {

			$userService = new UserService();
		    $result = $userService->register($_POST['username'],$_POST['password']);
			echo $result;
			#echo $result;
	}
	else{
		$result = ["code"=>"1", "message" => "Please complete every field."];
	 	echo json_encode($result);
	 	#echo $result;
	}

?>