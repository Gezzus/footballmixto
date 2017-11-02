<?php 
include("connect.php");

	/*$test = "ALTER TABLE `advertisers`
			ADD CONSTRAINT `advertisers_ibfk_1`
			FOREIGN KEY (`advertiser_id`) REFERENCES `jobs` (`advertiser_id`)
			ON DELETE CASCADE";
	$game_delete = "DELETE FROM game WHERE id='".$_POST['id']."'"; #TODO*/

	$game_hide = "UPDATE game SET status='1' WHERE id='".$_POST['id']."'";
	
		if(mysqli_query($link,$game_hide)){
					$backlocation = "location:../index.php";
					header($backlocation);
				}
				else {
					$backErrorlocation = "location:../index.php?error=1";
					#header($backErrorlocation);
					echo mysqli_error($link);
				}



?>
