<?php
include("../../src/model/Player.php");

echo "<pre>";
$test1 = Player::createPlayer("newNi12114k", 2);
print_r($test1->toJson());
echo "<br>";
$test2 = Player::getPlayer($test1->getId());
print_r($test2->toJson());
Player::deletePlayer("newNi12114k");
echo "</pre>"
	
?>