<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php");

$date = "2018-01-30 19:05:00";
$typeId = "2";
$doodleUrl = "test";
$playerId = "200";

echo "<pre>";
$test1 = Game::getById(31);
#$test1 = Game::create($date, $typeId, $doodleUrl);

echo "<code>";
print_r($test1->toJson());
#echo "</code>";

echo $test1->addPlayer($playerId);
echo $test1->addPlayer($playerId+3);


#echo "<hr>";
print_r($test1->toJson());
echo "</code>";
echo "<hr>";
echo "</pre>";
#print_r($test1->toJson());
#$teamTest = $test1->getTeam("2");
#$game = $test1->toArray();
#$gameId = $game["id"];
#var_dump($game);
#echo "<br> GAME ID: ".$gameId;
#echo "Returned: ".$teamTest->transferPlayer($gameId,"12");
#echo "<hr>";

#echo "<code>";
#print_r($test1->toJson());
#echo "</code>";
#echo "<hr>";
#$player = Player::getById("12");
#$player->toJson();
#echo "<hr>";
#echo "</pre>";
#$test1->delete();
