<?

class user{
	private function retrieve_user(){

	}

}

class player extends user{
	private function retrieve_player(){
	
	}		
			

}

class team extends player{

	private function retrieve_team(){



	}



}

class game extends team{

	 public function query_retrieve_game($received_game_id,$activelink){
            $game_retrieve = "SELECT game.typeId,game.date,gameType.type FROM game LEFT JOIN gameType ON game.typeId=gameType.id WHERE game.id=".$received_game_id;
            $game_retrieve_query = mysqli_query($activelink,$game_retrieve);
            #TODO: Error logic- returnmysqli_error
            return $game_retrieve_query;

        }

	public function query_retrieve_game_attendants($received_game_id,$activelink){

		$game_retrieve_attendants = "SELECT pickPlayer.teamId as 'playerTeamId',pickPlayer.playerId as 'playerId',player.nickName as 'nickName',player.genderId as 'genderId' FROM game LEFT JOIN pickPlayer ON game.id=pickPlayer.gameId LEFT JOIN player ON player.id=pickPlayer.playerId WHERE game.id=".$received_game_id;
		$game_retrieve_attendants_query = mysqli_query($activelink,$game_retrieve_attendants);
		#TODO: Error logic- returnmysqli_error
		return $game_retrieve_attendants_query;
    	}


}
