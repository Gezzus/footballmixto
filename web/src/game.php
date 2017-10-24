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
            $game_retrieve = "SELECT game.typeId,game.date,gameType.type as 'gameType.type',pickPlayer.teamId as 'pickPlayer.teamId',pickPlayer.playerId as 'pickPlayer.playerId' FROM game LEFT JOIN gameType ON game.typeId=gameType.id LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId LEFT JOIN player ON player.id=pickPlayer.playerId WHERE game.id=".$received_game_id;

            $game_retrieve_query = mysqli_query($activelink,$game_retrieve);
            $game_retrieve_row = mysqli_fetch_assoc($game_retrieve_query);

            


            $this->id = $received_game_id;
            $this->properties["type_desc"] = $game_retrieve_row["gameType.type"];
            $this->properties["date"] = $game_retrieve_row["date"];


            $game_retrieve_attendants = "SELECT pickPlayer.teamId as 'pickPlayer.teamId',pickPlayer.playerId as 'pickPlayer.playerId',player.nickName as 'player.nickName',player.genderId as 'player.genderId' FROM game LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId LEFT JOIN player ON player.id=pickPlayer.playerId WHERE game.id=".$received_game_id;
            $game_retrieve_attendants_query = mysqli_query($activelink,$game_retrieve_attendants);
            $game_retrieve_attendants_row = mysqli_fetch_assoc($game_retrieve_attendants_query);
            $game_retrieve_attendants_amount = mysqli_num_rows($game_retrieve_attendants_query);

            $this->attendants["id"] = [];
            $this->attendants["nickName"] = [];
            $this->attendants["team"] = [];
            $this->attendants["gender"] = [];

            for ($i=0; $i < $game_retrieve_attendants_amount; $i++) { 
                array_push($this->attendants["id"],$game_retrieve_attendants_row["pickPlayer.playerId"]);
                array_push($this->attendants["nickName"],$game_retrieve_attendants_row["player.nickName"]);
                array_push($this->attendants["team"],$game_retrieve_attendants_row["pickPlayer.teamId"]);
                array_push($this->attendants["gender"],$game_retrieve_attendants_row["player.genderId"]);
                $game_retrieve_attendants_row = mysqli_fetch_assoc($game_retrieve_attendants_query); 
            }
        }

        public function retrieve_team($received_game_id,$received_team_id)
        {
            $team_attendants["nickname"] = [];
            $team_attendants["gender"] = [];
            $team_attendants["id"] = [];
            
            for ($i=0; $i < count($this->attendants["id"]); $i++) { 
                if($this->attendants["team"][$i] == $received_team_id)
                {
                    array_push($team_attendants["nickname"],$this->attendants["nickName"][$i]);
                    array_push($team_attendants["gender"],$this->attendants["gender"][$i]);
                    array_push($team_attendants["id"],$this->attendants["id"][$i]);
                }
            }
            return $team_attendants;
                
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