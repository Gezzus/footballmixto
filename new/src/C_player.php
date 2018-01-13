<?php

	class player{

		function __construct(){

		}

		private function db_create_player($received_nickname,$received_gender,$mysqli){
			$query_find_player = "SELECT * FROM player WHERE nickname = '".$received_nickname."' AND genderId = '".$received_gender."'";
			#echo $query_find_player; 
			$result_query_find_player = $mysqli->query($query_find_player);
			#echo $mysqli->error;
			$result_amount = $result_query_find_player->num_rows;

			if($result_amount == 0){
				$query_create_player = "INSERT INTO player(nickname,genderId) VALUES('".$received_nickname."','".$received_gender."')";
				$result_query_create_player = $mysqli->query($query_create_player);
				echo $mysqli->error;
				#TODO ERROR
				$response = [200,$mysqli->insert_id];
				return $response; 	
			}
			else{
				$response = [201,"Nickname and gender combination already exists."];
				return $response;
			}
		}

		private function db_retrieve_player($received_id,$mysqli){
			$query_find_player = "SELECT * FROM player WHERE id = '".$received_id."' LIMIT 1"; 
			$result_query_find_player = $mysqli->query($query_find_player);
			$result_amount = $result_query_find_player->num_rows;
			if($result_amount == 1){
				return $response = [200,$result_query_find_player->fetch_array];
			}
			else{
				$response = [201,"Id doesn't exist."];
			}
		}	

		public function __construct_existing($received_player_id,$mysqli){
			$this->properties["id"] = $received_player_id;
			$response = $this->db_retrieve_player($received_player_id,$mysqli);
			print_r($response);
		}

		public function __construct_new($received_player,$mysqli){
			$response = $this->db_create_player($received_player[0],$received_player[1],$mysqli);
			
			if($response[0] == 200){
				$this->properties["id"] = $response[0];
				$this->properties["nickname"] = $received_player[0];
				$this->properties["gender"] = $received_player[1];
				$response[0] = [200,null];
				print_r($this->properties);
				return $response;
			}
			else{
				return $response;
			}
			
		}
		#function __construct($received_id);

		public function retrieve(){
			return $this;
		}

	}



	

?>

