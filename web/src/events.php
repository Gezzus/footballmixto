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


    class events{
        public $games;
        function __construct(){

        }
        function retrieve(){
            return $this->games;
        }

        function generate(){
            $events_retrieve = "SELECT game.id,game.date, FROM game LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId";
            $events_retrieve_query = mysqli_query($link,$events_retrieve);
            $events_retrieve_query_row = mysqli_fetch_assoc($task_query_retrieve);
            $events_retrieve_query_amount = mysqli_num_rows($task_query_retrieve);

            for ($i=0; $i < $events_retrieve_query_amount; $i++) { 
                $this->games[i] = new game($events_retrieve_query_row['id'],$events_retrieve_query_row['date'],$events_retrieve_query_row['attendants']);
            }
        }



    }   
            
 
    $Events = new events;
  
    $testAttendants = [1,2,3,6];

    $Events->games[0] = new game(1,"test",$testAttendants);

    $Events->games[1] = new game(2,"test",$testAttendants);

    $Events->games[2] = new game(3,"test",$testAttendants);
    $Events->games[3] = new game(4,"test",$testAttendants);
    $Events->games[4] = new game(5,"test",$testAttendants);

    //echo $Events->retrieve()." ";


?>