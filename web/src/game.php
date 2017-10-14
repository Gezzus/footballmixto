<?php

class game{

        public function __construct (){

        }

        public function build($received_game_id,$received_game_type,$received_game_date,$received_game_typedesc){
            $this->id = $received_game_id;
            $this->properties["type"] = $received_game_type;
            $this->properties["type_desc"] = $received_game_typedesc;
            $this->date = $received_game_date;
            #$this->attendants = $recieved_game_attendants;
        }

        public function retrieve($received_game_id,$activelink){
            $game_retrieve = "SELECT game.typeId,game.date,gameType.type as 'gameType.type' FROM game LEFT JOIN gameType ON game.typeId=gameType.id LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId WHERE game.id=".$received_game_id;

            $game_retrieve_query = mysqli_query($activelink,$game_retrieve);
            $game_retrieve_row = mysqli_fetch_assoc($game_retrieve_query);

            $this->id = $received_game_id;
            $this->properties["type_desc"] = $game_retrieve_row["gameType.type"];
            $this->properties["date"] = $game_retrieve_row["date"];
        }


        public function add($active_link,$type,$date){
            $game_add = "INSERT INTO game(date,typeId) VALUES('".$date."','".$type."')";
            if(! $game_add_query = mysqli_query($activelink,$game_add)){
            echo mysqli_error($activelink);
            }
            else{
                header("location:../index.php");
            }
        }

    }

?>