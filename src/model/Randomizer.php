<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Player.php";


class Randomizer {

	public static function randomize($gameId) {
       	$game = Game::getById($gameId);
       	$info = $game->getInfo();
       	$teamsCount = $info[0]['teamsAmount'];
       	$amountsByGender = array();
       	$peopleByGender = array();
       	$losers = array();
       
       	foreach ($info as $typeByGender) {
       		$amountsByGender[$typeByGender['genderId']] = $typeByGender['amount'];
       		$peopleByGender[$typeByGender['genderId']] = array();
       	}

       	$peopleToRandomize = $game->getTeamless();
       	for ($i = 0; $i < $peopleToRandomize->size(); $i++) {
       		$possiblePlayer = $peopleToRandomize->get($i);
       		$peopleByGender[$possiblePlayer->getGenderId()][] = $possiblePlayer;
       	}

       	foreach ($amountsByGender as $genderId => $amount) {
       		$loserPositions = array();
       		$unnecesaryPeopleCount = count($peopleByGender[$genderId]) - $amount;
       		if ($unnecesaryPeopleCount > 0) {
       			$loserPositions = array_merge($loserPositions, array_rand($peopleByGender[$genderId], $unnecesaryPeopleCount));
       		}

       		foreach ($loserPositions  as $loserPosition) {
       			$losers[] = $peopleByGender[$genderId][$loserPosition];
       		}
       	}

       	return self::parseResult($losers);
	}

	private static function parseResult($losers) {
		$result = '';
		foreach ($losers as $loser) {
       		$result .= $loser->getNickName() . "\n";
       	}
       	
       	$result = $result ? $result : 'No people to kick out!';

       	return trim($result, ',');
	}
}