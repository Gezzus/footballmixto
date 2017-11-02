<?php

include("connect.php");
session_start();


$player_getid = "SELECT playerId FROM user where id='".$_SESSION["id"]."'";
$player_getid_query = mysqli_query($link,$player_getid);
$player_getid_row = mysqli_fetch_assoc($player_getid_query);

echo $player_getid."<br>";
#echo var_dump($player_getid_query);
echo $player_getid_row["playerId"]."<br>";
echo mysqli_error($link);


$player_event_join = "INSERT INTO pickPlayer(gameId,playerId,teamId) VALUES('".$_POST["gameId"]."','".$player_getid_row["playerId"]."','5')";
		echo $player_event_join."<br>";
		if(mysqli_query($link,$player_event_join)){
					$backlocation = "location:../game.php?id=".$_POST["gameId"];
					header($backlocation);
					echo mysqli_error($link);
					#echo $backlocation;
				}
				else {
					$backErrorlocation = "location:../game.php?id=".$_POST["gameId"]."&error=1";
					header($backErrorlocation);
					#echo mysqli_error($link);
					#echo $backErrorlocation;

				}

?>