<?php
    $query_game_retrieve;
    $query_;

    class game
    {
        private $game_id;
        private $game_date;
        private $attendants = [
                                "female" => [ 
                                         ],
                                "men" => [ 
                                      ]
                              ];
        private $properties = [
                                "type" => ""
                              ];

        public function __construct ($received_game_type,$received_game_date)
        {
            $this->game_id = $received_game_type;
            $this->game_date = $received_game_date;
        }

        public function retrieve()
        {
            echo "Id: ".$this->game_id." & Date:".$this->game_date;
        }

    }


    class events
    {
        private $games = [];
        function __construct()
        {
            $events_retrieve = "";
            $events_retrieve_query = mysqli_query($link,$events_retrieve);
            $events_retrieve_query_row = mysqli_fetch_assoc($task_query_retrieve);
            $events_retrieve_query_amount = mysqli_num_rows($task_query_retrieve);

            for ($i=0; $i < $events_retrieve_query_amount; $i++) { 
                $this->games[i] = new game($events_retrieve_query_row['id'],$events_retrieve_query_row['date']);
            }

        }
        function retrieve()
        {
            for($i = 0;$i < count($this->games); $i++)
            {
                echo $this->games[$i]->retrieve();  
            }
        }
    }

    /*$Games = [];
    $Games[0]= new game("1","dateHere");
    $Games[1]= new game("2","dateHere");
    $Games[2]= new game("3","dateHere");*/
    

    /**/





?>
