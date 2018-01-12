<?php

	class player{
		
		#private $properties = ["id","nickname","gender"];

		function __construct($received_id,$received_nickname,$received_gender){
			$this->properties["id"] = $received_id;
			$this->properties["nickname"] = $received_nickname;		
			$this->properties["gender"] = $received_gender;
		}

		public function retrieve(){
			return $this;
		}

	}



	

?>

