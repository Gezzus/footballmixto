<?php

	function retrieve_users($activelink){
		$select_users = "SELECT user.id,player.nickName FROM user LEFT JOIN player ON user.playerId=player.id";
		$select_users_query = mysqli_query($activelink,$select_users);
		return $select_users_query;
	}

	

	function retrieve_users_display($activelink)
	{
		$users = retrieve_users($activelink);
		for ($i=0; $i < mysqli_num_rows($users); $i++) { 
			$users_row = mysqli_fetch_assoc($users);
			?>
			<button class="content team" style=""><?= $users_row['nickName']?></button><hr class="content" style="margin-bottom: 0px;">
			<?
		}
		

	}

	

	function winner_display($players_string,$activelink)
	{	
		$players = explode(",",$players_string);
		#echo var_dump($players);
		for ($i=0; $i < count($players); $i++) {
			$cur_player = retrieve_player($activelink,$players[$i]);
			$cur_player_row = mysqli_fetch_assoc($cur_player);
			?><button class="content team"><?= $cur_player_row['nickName']?></button><?
		}
	}

	

	


?>