<?php

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
            
 
   

?>