<?php

	class player{
		
		private $properties = ["id","nickname","gender"];

		private function __construct($received_id,$received_nickname,$received_gender){
			$this->properties["id"] = $received_id;
			$this->properties["nickname"] = $received_size;		
			$this->properties["gender"] = $received_date;
		}

		public function retrieve(){
			return $this;
		}

	}



	

?>

