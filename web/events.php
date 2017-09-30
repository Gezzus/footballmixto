<?php

    class game
    {
        private $id;
        private $date;
        private $attendants = [
                                "female" => [ 
                                         ],
                                "men" => [ 
                                      ]
                              ];
        private $properties = [
                                "type" => ""
                              ];

        public function __construct ($received_game_type,$received_game_date){
            $this->id = $received_game_type;
            $this->date = $received_game_date;
        }

        public function retrieve(){
            echo "Id: ".$this->id." & Date:".$this->date;
        }

        public function retrieve_attendants(){
                 return $this->attendants;
        }
        public function retrieve_attendant(){
                 return $this->attendants;
        }

        public function store()
        {
            $insert_game = "INSERT VALUES($this->id,$this->date) IN game(id,date)";
            $insert_game_query = mysqli_query($link,$events_retrieve);
        }

    }


    class events
    {
        private $games = [];
        function __construct()
        {
            

        }
        function retrieve()
        {

            for($i = 0;$i < count($this->games); $i++)
            {
                echo $this->games[$i]->retrieve();  
            }
        }

        function generate()
        {
            $events_retrieve = "SELECT id date FROM game";
            $events_retrieve_query = mysqli_query($link,$events_retrieve);
            $events_retrieve_query_row = mysqli_fetch_assoc($task_query_retrieve);
            $events_retrieve_query_amount = mysqli_num_rows($task_query_retrieve);

            for ($i=0; $i < $events_retrieve_query_amount; $i++) { 
                $this->games[i] = new game($events_retrieve_query_row['id'],$events_retrieve_query_row['date']);
            }
        }



    }

    $Events = new events;
    echo $events->retrieve();


    /**/





?>
