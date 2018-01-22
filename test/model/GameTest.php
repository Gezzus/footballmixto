<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php");

$date = "2018-01-30 19:03:00";
$typeId = "2";
$doodleUrl = "test";
$playerId = "203";

echo "<pre>";
$test1 = Game::getById(65);
#$test1 = Game::create($date, $typeId, $doodleUrl);

echo "<code>";
print_r($test1->toJson());
echo "</code>";
echo "<hr>";
$test1->addPlayer($playerId);
$test1->addPlayer($playerId+1);
echo "<hr>";

echo "<code>";
print_r($test1->toJson());
echo "</code>";
echo "<hr>";

echo "</pre>";
#$test1->delete();

?>