<?php

function player_change_team($activelink,$received_game_id,$received_player_id,$received_newteam_id)
        {
            if($received_newteam_id == 'D')
            {
                $player_delete = "DELETE FROM pickPlayer WHERE playerId='".$received_player_id."' AND gameId='".$received_game_id."'";
                $player_delete_query = mysqli_query($activelink,$player_delete);
                #echo $player_delete;
                echo mysqli_error($activelink);
                header("location:../game.php?id=".$received_game_id);
            }
            else{
            $player_changeteam = "UPDATE pickPlayer SET teamId='".$received_newteam_id."' WHERE gameId='".$received_game_id."' AND playerId='".$received_player_id."'";
            $player_changeteam_query = mysqli_query($activelink,$player_changeteam);
            #echo $player_changeteam."<br>";
            echo mysqli_error($activelink);
            header("location:../game.php?id=".$received_game_id);
            }
        }


include("connect.php");
if(isset($_GET['action']) AND $_GET['action'] == "teamchange")
{
    $received_newteam_id =  filter_var($_POST["team"],FILTER_SANITIZE_STRING);
    $received_player_id =  filter_var($_POST["id"],FILTER_SANITIZE_STRING);
    $received_game_id  = filter_var($_GET["id"],FILTER_SANITIZE_STRING);
    player_change_team($link,$received_game_id,$received_player_id,$received_newteam_id);
}
?>