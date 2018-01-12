<?php
	class team {

		private $players;
		private $properties = ["id","size"];

		private function __construct($received_id,$received_size,$received_players){
			$this->players = [];
			$this->properties["id"] = $received_id;
			$this->properties["size"] = $received_size;		

			for ($i=0; $i < count($received_players); $i++){
				array_push($this->players,$received_players[$i]);
			}
		}

		public function retrieve(){
			return $this;
		}

		public function add_player($player_id){
			array_push($this->players,$player_id);
			#db_team_add_player(); TODO

		}

		public function remove_player($player_id){
			$player_team_position = array_search($player_id, $this->players);
			unset($this->players[$player_team_position]);
			#db_team_remove_player(); TODO
		}


		public function db_team_retrieve($team_received_properties,$team_id,$mysqli){
			
			$retrieve_team_properties = implode(",",$team_received_properties);
			$query_retrieve_team = "SELECT ".$retrieve_team_properties." FROM team WHERE id='".$team_id."'";
			$result_retrieve_team = $mysqli->query($query_retrieve_team);
			 return result_retrieve_team->fetch_array();		
		
		}



		private function db_team_add_player($team_id,$player_id,$mysqli){

			$db_request_array = ["players","size"];
			$db_team_size_query = db_team_retrieve($db_request_array,$team_id,$mysqli);
			$db_team_size = count($db_team_size_query["size"]);
			$db_team_cur_amount = count($db_team_size_query["players"])

			$db_team_players = implode(",",$db_team_size_query["players"]);

			if($db_team_cur_amount < $db_team_size){
				$query_db_team_add_player = "UPDATE team SET players='"db_team_players.",".$player_id."' WHERE team_id='".$team_id."'";
				$result_query_db_team_add_player = $mysqli->query($query_db_team_add_player);
				if(!$result_query_db_team_add_player){
					$response = ["status":200,"errors":null];
					return $response;
				}				
				else{
					$response = ["status":501,"error":"Internal server error"];
					return $response;
				}


			}
			else return "Error -> Cur Amount == Team Size"; #ToDo
			
		}


		
		

	}

?>