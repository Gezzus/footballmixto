<?php

	class User extends Player{

		function __construct($received_id, $received_username, $received_password){
			$this->properties["playerId"] = $this->propeties["id"];
			$this->properties["id"] = $received_id;
			$this->properties["username"] = $received_username;
			$this->properties["password"] = $received_password;
		}

		function __construct($received_id, $mysqli){
			$user_data = retrieve_user_db($received_id, $mysqli);
			$this->properties["id"] = $user_data["id"];
			$this->properties["username"] = $user_data["username"];
			$this->properties["password"] = $user_data["password"];
			$this->properties["playerId"] = $user_data["playerId"];
		}



		private function retrieve_user_db($id,$mysqli){
			$query_retrieve_user = "SELECT * FROM user WHERE id='" . $id . "' LIMIT 1";
			$query_result = $mysqli->query($query_retrieve_user);
			return $mysqli->fetch_assoc($query_result);
		}


		public function retrieve(){
			return $this;
		}
		
	}
?>