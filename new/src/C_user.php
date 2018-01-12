<?php

	class user extends player{



		public function __construct($received_id,$received_nickname,$received_gender){
			$this->properties["playerId"] = $this->propeties["id"];
			$this->properties["id"] = $received_id;

		}

		public function retrieve(){
			return $this;
		}
		
	}
?>