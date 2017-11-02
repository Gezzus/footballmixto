<?php

include("menumanager.php");
        
        function query_retrieve_game($received_game_id,$activelink){
            $game_retrieve = "SELECT game.typeId,game.date,gameType.type as 'type' FROM game LEFT JOIN gameType ON game.typeId=gameType.id WHERE game.id='".$received_game_id."'";

            $game_retrieve_query = mysqli_query($activelink,$game_retrieve);
            #$game_retrieve_row = mysqli_fetch_assoc($game_retrieve_query);
            $game_retrieve_amount = mysqli_num_rows($game_retrieve_query);
           /* $this->id = $received_game_id;
            $this->properties["type_desc"] = $game_retrieve_row["gameType.type"];
            $this->properties["date"] = $game_retrieve_row["date"];
           */
            #echo $game_retrieve;
            if ($game_retrieve_amount == 0){
                return "Error";#To do
            }
            else{
                return $game_retrieve_query;
            }

            
        }

        function query_retrieve_team($received_game_id,$received_team_id,$activelink){
           $game_retrieve_team = "SELECT pickPlayer.teamId as 'pickPlayer.teamId',pickPlayer.playerId as 'pickPlayer.playerId',player.nickName as 'player.nickName',player.genderId as 'player.genderId' FROM game LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId LEFT JOIN player ON player.id=pickPlayer.playerId WHERE game.id='".$received_game_id."' AND pickPlayer.teamId='".$received_team_id."'";
            $game_retrieve_team_query = mysqli_query($activelink,$game_retrieve_team);
            #$game_retrieve_attendants_row = mysqli_fetch_assoc($game_retrieve_attendants_query);
            $game_retrieve_team_amount = mysqli_num_rows($game_retrieve_team_query);

             if ($game_retrieve_team_amount == 0){
                return "Error";#To do
            }
            else{
                return $game_retrieve_team_query;
            } 
        }

         function query_retrieve_attendants($received_game_id,$activelink)
        {
            $game_retrieve_attendants = "SELECT pickPlayer.teamId as 'pickPlayer.teamId',pickPlayer.playerId as 'pickPlayer.playerId',player.nickName as 'player.nickName',player.genderId as 'player.genderId' FROM game LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId LEFT JOIN player ON player.id=pickPlayer.playerId WHERE game.id=".$received_game_id;
            $game_retrieve_attendants_query = mysqli_query($activelink,$game_retrieve_attendants);
            #$game_retrieve_attendants_row = mysqli_fetch_assoc($game_retrieve_attendants_query);
            $game_retrieve_attendants_amount = mysqli_num_rows($game_retrieve_attendants_query);

             if ($game_retrieve_attendants_amount == 0){
                return "Error";#To do
            }
            else{
                return $game_retrieve_attendants_query;
            }

        }

    function query_games_retrieve_all($activelink)
    {
        $games_retrieve = "SELECT game.id as 'game.id',game.typeId,game.date,gameType.type as 'type' FROM game LEFT JOIN gameType ON game.typeId=gameType.id WHERE status=0";
            $games_retrieve_query = mysqli_query($activelink,$games_retrieve);
            //$games_retrieve_query_row = mysqli_fetch_assoc($events_retrieve_query);
            $games_retrieve_query_amount = mysqli_num_rows($games_retrieve_query);
            if ($games_retrieve_query_amount == 0){
                return "Error";#To do
            }
            else{
                return $games_retrieve_query;
            }
    }


     function organize_games($activelink)
     {
        $games  = query_games_retrieve_all($activelink);
        if ($games == "Error")
        {
            return "There are no games available";
        }

        $games_row = mysqli_fetch_assoc($games);
        $games_ammount = mysqli_num_rows($games);

        for ($i=0; $i < $games_ammount; $i++) { ?>
            <div class='col-3 team content'">
                <label style="width:100%"><b>Date:</b><br><?= $games_row["date"] ?></label>
                <label style="width:100%"><b>Description:</b><br><?= $games_row["type"]  ?></label>
                <hr class="content">
                <a href="game.php?id=<?=$games_row['game.id']?>"><button class="content">See event</button></a>
            </div><?
            $games_row = mysqli_fetch_assoc($games);
        }

     }

     function organize_team($received_game_id,$received_team_id,$activelink,$received_option,$received_user_id){
        $team_query = query_retrieve_team($received_game_id,$received_team_id,$activelink);
               # echo var_dump($team_query);
        

        if ($team_query == "Error"){
            return "No players yet";
            }

        $team_ammount = mysqli_num_rows($team_query);

        ?><div class="row"><?
        
        for ($i=0; $i < $team_ammount; $i++) {
            $team_row = mysqli_fetch_assoc($team_query);
            switch ($team_row["player.genderId"]) {
                case 1:
                    $team_color = "#FFC0CB";
                    break;
                
                case 2:
                    $team_color = "#ADD8E6";
                    break;
            }

            if($received_option == '0'){
            ?>
                <div class='col-2 team' style="width:100%;background-color:<?= $team_color ?>">
                <label><?=$team_row["player.nickName"];?></label>
                <form method='POST' action='src/operatory.php?action=teamchange&id=<?=$received_game_id?>'>
                <?
                if(isAdmin($received_user_id,$activelink)){
                ?>
                 <input name='id' value="<?=$team_row['pickPlayer.playerId']?>" hidden></input>
                  <button class='content team' name='team' value='1'>1</button>
                  <button class='content team' name='team' value='2'>2</button>
                  <button class='content team' name='team' value='3'>3</button>
                  <button class='content team' name='team' value='4'>4</button>
                </form>
                
                <?
                }
        }  
        else if($received_option == '1'){
            ?>
                <div class='col team' style="width:100%;background-color:#eeeeee">
                <label><?=$team_row["player.nickName"];?></label>
                <?
                if(isAdmin($received_user_id,$activelink)){
                ?>
                <form method="POST" action="src/operatory.php?action=teamchange&id=<?=$received_game_id?>">
                <input name="id" hidden value="<?=$team_row['pickPlayer.playerId']?>"></input>
                <button class="content team" name='team' value='5' type="submit">R</button>
                </form>
            <?
                }
            }
        ?>
        </div>  
        <?
        }
        ?>
        </div>
        <?
    }

     function game_retrieve($received_game_id,$activelink){

        $game_query = query_retrieve_game($received_game_id,$activelink);
        $game_row = mysqli_fetch_assoc($game_query);
         if ($game_row == "Error"){
            return "There are no events with this id available";
            }
        return $game_row;
     }


     function game_organize_teams($received_game_id,$activelink,$received_user_id)
     {

        $gameType_query = query_retrieve_game($received_game_id,$activelink);
        $gameType_row = mysqli_fetch_assoc($gameType_query);

        switch ($gameType_row["type"]) {
            case '5 vs 5 (2 fields)':
                ?>

                <div class="row">
                
                <div class="col team">
                <h6>Team 1</h6>
                <hr class="content"> 
                <? organize_team($received_game_id,'1',$activelink,'1',$received_user_id); ?>
                </div>
                <div class="col team">
                <h6>Team 2</h6>
                <hr class="content"> 
                <? organize_team($received_game_id,'2',$activelink,'1',$received_user_id); ?>
                </div>
                <div class="col team">
                <h6>Team 3</h6>
                <hr class="content"> 
                <? organize_team($received_game_id,'3',$activelink,'1',$received_user_id); ?>
                </div>
                <div class="col team">
                <h6>Team 4</h6>
                <hr class="content">
                <? organize_team($received_game_id,'4',$activelink,'1',$received_user_id); ?> 
                </div>
                </div><?
                break;
            
            default:
                break;
        }

     }

     function game_retrieve_attribute_ammount($received_game_id,$activelink,$attribute,$attribute_value){

        $attendants = query_retrieve_attendants($received_game_id,$activelink);
        $attendant_row = mysqli_fetch_assoc($attendants);

        $attendants_amount = 0;
        #$attendant = mysqli_fetch_assoc($attendants);
        for ($i=0; $i < mysqli_num_rows($attendants); $i++) { 
         
           if($attendant_row[$attribute] == $attribute_value)
           {
             $attendants_amount++;
           }
           $attendant_row = mysqli_fetch_assoc($attendants);
        }

        return $attendants_amount;

     }


?>