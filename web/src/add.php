<?php

include("connect.php");
session_start();

$received_nickname =  filter_var($_POST["nickname"],FILTER_SANITIZE_STRING);

switch ($_POST["gender"]){
	case "Female":
	{
		$received_genderId = 1;
		break;
	}
	case "Male":
	{
		$received_genderId = 2;
		break;
	}
}


#Checks if exists:

$player_query_exists = "SELECT id,nickName FROM player WHERE nickName='".$received_nickname."'";
$player_query_exists_result = mysqli_query($link,$player_query_exists);
echo mysqli_error($link);
$player_query_exists_row = mysqli_fetch_assoc($player_query_exists_result);
$player_query_exists_amount = mysqli_num_rows($player_query_exists_result);

if($player_query_exists_amount == 0){
	$player_query_create = "INSERT INTO player(nickName,genderId,levelId) VALUES('".$received_nickname."','".$received_genderId."','1')";
			if(mysqli_query($link,$player_query_create)){
				$player_query_lastid = mysqli_insert_id($link);
				$player_event_add = "INSERT INTO pickPlayer(gameId,playerId,teamId) VALUES('".$_POST["gameId"]."','".$player_query_lastid."','5')";
				if(mysqli_query($link,$player_event_add)){
					$backlocation = "location:../event.php?id=".$_POST["gameId"];
					header($backlocation);
					echo mysqli_error($link);
					echo $backlocation;
				}
			}
			else {
				$backErrorlocation = "location:../event.php?id=".$_POST["gameId"]."&error=1";
				#header($backErrorlocation);
				echo mysqli_error($link);
				echo $backErrorlocation;
			}
	}
	else
	{
		echo "Did i get in here?";
		$player_event_add = "INSERT INTO pickPlayer(gameId,playerId,teamId) VALUES('".$_POST["gameId"]."','".$player_query_exists_row["id"]."','5')";
		echo $player_event_add."<br>";
		if(mysqli_query($link,$player_event_add)){
					$backlocation = "location:../event.php?id=".$_POST["gameId"];
					header($backlocation);
					echo mysqli_error($link);
					echo $backlocation;
				}
				else {
					$backErrorlocation = "location:../event.php?id=".$_POST["gameId"]."&error=1";
					#header($backErrorlocation);
					echo mysqli_error($link);
					echo $backErrorlocation;
				}
	}

?>