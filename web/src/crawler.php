<?php 

include("connect.php");
include("game.php");

$doodleUrl = $_POST["doodleUrl"];
$game_id = $_POST["game_id"];
sampleCrawler($link,$doodleUrl,$game_id);

function  sampleCrawler($activelink,$doodleUrl,$game_id)
{
$doodlePath = explode('/',$doodleUrl);
print_r($doodlePath);
#echo $crawledPath[4];

$game_data_json = file_get_contents("https://doodle.com/api/v2.0/polls/".$doodlePath[4]);
$game_data = json_decode($game_data_json);

for ($i=0; $i < count($game_data->participants); $i++) { 
	#echo $game_data->participants[$i]->name." ".."<br>";
		query_addplayer($activelink,$game_id,$game_data->participants[$i]->name,$game_data->participants[$i]->preferences[0]);
	}

header("location:../game.php?id=".$game_id);

}


?>