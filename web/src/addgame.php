<?php

include("connect.php");
session_start();

#$received_gameName =  filter_var($_POST[""],FILTER_SANITIZE_STRING);
$received_gameType =  filter_var($_POST["type"],FILTER_SANITIZE_STRING);
$received_gameDate =  filter_var($_POST["date"],FILTER_SANITIZE_STRING);
$received_gameTime =  filter_var($_POST["time"],FILTER_SANITIZE_STRING);


#echo $received_gameDate . $received_gameTime."<br>";


		$game_add = "INSERT INTO game(date,typeId) VALUES('".$received_gameDate." ".$received_gameTime."','".$received_gameType."')"; #TODO
		

		#echo $game_add."<br>";
		if(mysqli_query($link,$game_add)){
					$backlocation = "location:../index.php";
					header($backlocation);
				}
				else {
					$backErrorlocation = "location:../index.php?error=1";
					#header($backErrorlocation);
					echo mysqli_error($link);
				}

?>