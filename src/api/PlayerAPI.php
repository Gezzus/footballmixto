<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Player.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";

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
        return Player::get($nickName, $genderId);
    }
    
    
}
