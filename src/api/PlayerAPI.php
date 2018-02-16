<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Player.php";

class PlayerAPI {
    
    public static function getById($id) {
        $player = Player::getById($id);
        return $player;
    }
    
    public static function create($nickName, $genderId, $skillId) {
        $player = Player::create($nickName, $genderId, $skillId);
        return $player;
    }
    
    public static function get($nickName, $genderId) {
        $player = Player::get($nickName, $genderId);
        return $player;
    }

    public static function playerGames($id) {
        $player = Player::getById($id);
        return $player->getGames();
    }


}
