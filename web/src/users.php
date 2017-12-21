<?php

	function retrieve_users($activelink){
		$select_users = "SELECT user.id,player.nickName FROM user LEFT JOIN player ON user.playerId=player.id";
		$select_users_query = mysqli_query($activelink,$select_users);
		return $select_users_query;
	}

	function retrieve_players($activelink)
	{
		$select_players = "SELECT * FROM player";
		$select_players_query = mysqli_query($activelink,$select_players);
		return $select_players_query;
	}

	function retrieve_player($activelink,$id)
	{
		$select_player = "SELECT player.nickName FROM player WHERE id='".$id."'";
		$select_player_query = mysqli_query($activelink,$select_player);
		return $select_player_query;
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

	function retrieve_players_display($current_players,$activelink)
	{
		$players = retrieve_players($activelink);

		if(!$current_players == null){
			$current_players_array = explode(",",$current_players);

					for ($i=0; $i < mysqli_num_rows($players); $i++) { 
					$players_row = mysqli_fetch_assoc($players);

					if(!in_array($players_row['id'],$current_players_array)){

					?>
					<a href="randomizer.php?add=<?= $players_row['id']?>,<? if(isset($_GET['add'])){ echo $_GET['add']; } ?>"><button class="content team"><?= $players_row['nickName']?></button></a>
					<?
					}
			}
		}
		else		
		{ for ($i=0; $i < mysqli_num_rows($players); $i++) { 
			$players_row = mysqli_fetch_assoc($players);
			?>
			<a href="randomizer.php?add=<?= $players_row['id']?>,<? if(isset($_GET['add'])){ echo $_GET['add']; } ?>"><button class="content team"><?= $players_row['nickName']?></button></a>
			<?
			}
		}
	}

	function retrieve_players_display_select($activelink){
		$players = retrieve_players($activelink);
		for ($i=0; $i < mysqli_num_rows($players); $i++) { 
			$players_row = mysqli_fetch_assoc($players);
			?>
			<option value="<?= $players_row['id']?>"><?= $players_row['nickName']?></option>
			<?
			}

	}

	function players_display($players,$activelink)
	{
		$exploded_players = explode(",",$players);
		for ($i=0; $i < count($exploded_players)-1; $i++) {
		$cur_player = retrieve_player($activelink,$exploded_players[$i]);
		$cur_player_row = mysqli_fetch_assoc($cur_player);
			?><button class="content team"><?= $cur_player_row['nickName']?></button><?
		}
		?>
			<input name="pool" value="<?= implode(",",$exploded_players) ?>" hidden></input>
		<?
	}

	function  player_display_NickName($activelink,$id)
	{
		$player = retrieve_player($activelink,$id);
		$player_row = mysqli_fetch_assoc($player);
		return $player_row['nickName'];
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

	

	function players_return_random($players,$amount,$owner,$activelink)
	{
		$players_array = explode(",",$players);
		$players_array = array_filter($players_array);
		$players_array = array_unique($players_array);
		
		shuffle($players_array);
		$winners_array = [];
		for ($i=0; $i < $amount; $i++) { 
			#echo "<br>";
			#echo $players_array[$i];
			array_push($winners_array,$players_array[$i]);
		}
		$query_perseguido = "INSERT INTO randomizer(winners,participants,time,owner) VALUES('".filter_var(implode(",",$winners_array),FILTER_SANITIZE_STRING)."','".filter_var(implode(",",$players_array),FILTER_SANITIZE_STRING)."',NOW(),'".$owner."')";
		#echo $query_perseguido;
		#filter_var(implode(",",$winners_array),FILTER_SANITIZE_STRING)
		#filter_var(implode(",",$players_array),FILTER_SANITIZE_STRING)
		mysqli_query($activelink,$query_perseguido);
		mysqli_error($activelink);
		return $winners_array;
	}


?>