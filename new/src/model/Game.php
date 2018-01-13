<?php
	class Game {

		function __construct($received_id, $received_size, $received_teams){
			$this->teams = [];
			$this->properties["id"] = $received_id;
			$this->properties["size"] = $received_size;		

			for ($i=0; $i < count($received_players); $i++){
				array_push($this->players, $received_teams[$i]);
			}
		}

		public function retrieve(){
			return $this;
		}

		public function add_team($team_id){
			array_push($this->teams, $team_id);
		}

		public function remove_team($team_id){
			$team_position = array_search($team_id, $this->teams);
			unset($this->teams[$team_position]);
			#db_team_remove_player(); TODO
		}

		




	}

?>