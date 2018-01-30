<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";

class GameAPI {
    
    public static function get($id) {
        $game = Game::getById($id);
        if($game != null) {
            return $game;
        } else {
            return null;
        }
    }

    public static function create($date, $type, $doodleUrl) {
        $game = Game::create($date, $type, $doodleUrl);
        if($game != null) {
            return $game;
        } else {
            return null;
        }
    }
    
      
    public static function addPlayer($gameId, $playerId) {

    }
    
    public static function getPlayerById($playerId) {
        return Player::getById($playerId);
    }
    
    public static function getPlayer($nickName, $genderId) {
        return Player::get($nickName, $genderId);
    }
    
    public static function transferPlayer($gameId, $playerId, $teamId) {

    }
    
}
