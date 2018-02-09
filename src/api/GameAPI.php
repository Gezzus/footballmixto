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
       $game = Game::getById($gameId);
       if($game->addPlayer($playerId)){
           return true; // If this is returning true... how the hell am i drawing stuff :thinking:
       } else {
           return null;
       }
    }

    public static function removePlayer($gameId, $playerId) {
        $game = Game::getById($gameId);
        return $game->removePlayer($playerId);
    }

    
    public static function transferPlayer($gameId, $playerId, $teamId) {
       $game = Game::getById($gameId);
        #$teams = $game->getTeams();
        $team = $game->getTeam($teamId);
        return $team->transferPlayer($playerId,$gameId);
    }
}
