<?php
	class team {

		private $players;
		private $properties = ["id","size"];

		public function __construct($received_id,$received_size,$received_players){
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
		}

		public function remove_player($player_id){
			$player_team_position = array_search($player_id, $this->players);
			unset($this->players[$player_team_position]);
		}


	}

?>