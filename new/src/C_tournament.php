<?php

	class tournament extends team{

		#private $teams;
		#private $properties = ["id","size","date"];


		function __construct($received_id,$received_size,$received_date){
			$this->teams = [];
			$this->properties["id"] = $received_id;
			$this->properties["size"] = $received_size;		
			$this->properties["date"] = $received_date;

		}

		public function add_team($team_id,$team_size,$team_players){
			array_push($this->teams,new team($team_id,$team_size,$team_players));
		}


		public function retrieve(){
			return $this;
		}


	}

?>

