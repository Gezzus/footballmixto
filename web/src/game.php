<?php

class game{

        public function __construct ($received_game_type,$received_game_date,$recieved_game_attendants){
            $this->id = "AI";
            $this->properties["type"] = $received_game_type;
            $this->date = $received_game_date;
            $this->attendants = $recieved_game_attendants;
        }

        public function retrieve(){
            return $this;
        }

        public function retrieve_attendant(){
                 return $this->attendants;
        }


        public function store(){
            $insert_game = "INSERT VALUES($this->id,$this->date) IN game(id,date)";
            $insert_game_query = mysqli_query($link,$events_retrieve);

        }

    }

?>