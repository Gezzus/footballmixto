<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/SerializableCollection.php";

class Player extends PersistentEntity implements Seriarizable {

    private $id;
    private $nickName;
    private $genderId;
    private $levelId;
    private $games;

    public function __construct($id, $nickName, $genderId, $levelId) {
        $this->id = $id;
        $this->nickName = $nickName;
        $this->genderId = $genderId;
        $this->levelId = $levelId;
        $this->games = new SerializableCollection();
    }

    public static function create($nickName, $genderId, $skillId) {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
        if($dbPlayer->rowCount() == 0) {
            $player = self::queryWithParameters("INSERT INTO player (nickName, genderId, levelId) VALUES(?, ?, ?)", array($nickName, $genderId, $skillId));
            if($player){
                return self::getbyId(self::lastInsertId());
            } else {
                return null;
            }
        }
        else {
            return null;
        }
    }

    public static function getById($playerId){
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE id = ?", array($playerId));
        if($dbPlayer->rowCount() == 1) {
            $playerData = $dbPlayer->fetch();
            return new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"]);
        } else {
            return null;
        }
    }
    
    public static function get($nickName, $genderId){
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
        if($dbPlayer->rowCount() == 1) {
            $playerData = $dbPlayer->fetch();
            return new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"]);
        } else {
            return null;
        }
    }    
    
    public static function delete($nickName){
        self::queryWithParameters("DELETE FROM player WHERE nickName = ?", array($nickName));
    }

    public function toArray() {
        $return = [
            "id" => $this->id,
            "nickName" => $this->nickName,
            "genderId" => $this->genderId,
            "levelId" => $this->levelId
        ];
        return $return;
        
    }

    public function toJson() {
       return json_encode($this->toArray());
    }

    public function getId() {
        return $this->id;
    }

    public function getNickName() {
        return $this->nickName;
    }

    public function getGenderId() {
        return $this->genderId;
    }

    public function getLevelId() {
        return $this->levelId;
    }

    public function getGames() {
        $dbGames = self::queryWithParameters("SELECT * FROM pickPlayer where playerId= ?",array($this->id));
        for ($i = 0; $i < $dbGames->rowCount(); $i++){
            $dbGame = $dbGames->fetch();
            $game = Game::getById($dbGame['gameId']);
            $this->games->add($game);
        }
        return $this->games->toArray();
    }

}


/*public function toArray() {
    $return = [
        "games" => $this->games->toArray()
    ];
    return $return;

}

public function toJson() {
    return json_encode($this->toArray());
}*/