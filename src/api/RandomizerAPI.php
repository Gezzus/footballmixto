<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";

class RandomizerAPI {
    
    public static function randomize($gameId) {
       $game = Game::getById($gameId);
	}
}
