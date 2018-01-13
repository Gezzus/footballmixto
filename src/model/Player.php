<?php

    include_once "../config/Database.php";

	class Player extends PersistentEntity implements Seriarizable {

		private $id;
		private $nickName;
		private $genderId;
		private $levelId;

		

		function __construct($id, $nickName, $genderId, $levelId) {
            $this->id = $id;
            $this->nickName = $nickName;
            $this->genderId = $genderId;
            $this->levelId = $levelId;
		}

		private function create($nickName, $genderId) {
			$player = $this->queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
            if(count($player->fetchAll()) == 0){
                $this->queryWithParameters("INSERT INTO player(nickName, genderId) VALUES(?, ?)", array($nickName, $genderId));
				$this->id = $this->lastInsertId();
				return $this->toJson();
			}
			else{
				return null;
			}
		}

        public function toJson() {
            $return = [
                "id" => $this->id,
                "nickName" => $this->nickName,
                "genderId" => $this->genderId,
                "levelId" => $this->levelId
            ];
            return json_encode($return);
        }

        private function get($playerId){
            $player = $this->queryWithParameters("SELECT * FROM player WHERE id = ?", array($playerId));
            if(count($player->fetchAll()) == 1){

            }

            $query_find_player = "SELECT * FROM player WHERE id = '" . $received_id . "' LIMIT 1";
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

