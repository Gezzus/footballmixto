<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Randomizer.php";

class RandomizerAPI {
    
    public static function randomize($gameId) {
       	return Randomizer::randomize($gameId);
	}
}
