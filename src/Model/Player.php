<?php

namespace App\Model;

class Player extends PersistentEntity implements Seriarizable {

    private $id;
    private $nickName;
    private $genderId;
    private $levelId;
    private $games;

    public function __construct($id, $nickName, $genderId, $levelId, $hasInmunity = 0) {
        $this->id = $id;
        $this->nickName = $nickName;
        $this->genderId = $genderId;
        $this->levelId = $levelId;
        $this->hasInmunity = $hasInmunity;
        $this->games = new SerializableCollection();
    }

    public static function create($nickName, $genderId, $skillId) {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
        if ($dbPlayer->rowCount() == 0) {
            $player = self::queryWithParameters("INSERT INTO player (nickName, genderId, levelId) VALUES(?, ?, ?)", array($nickName, $genderId, $skillId));
            if ($player) {
                return self::getbyId(self::lastInsertId());
            } else {
                return null;
            }
        }
        else {
            return null;
        }
    }

    public static function getById($playerId) {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE id = ?", array(intval($playerId)));
        if ($dbPlayer->rowCount() == 1) {
            $playerData = $dbPlayer->fetch();
            return new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"], $playerData["hasInmunity"]);
        }
        return null;
    }

    public static function getAllWithInmunity() {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE hasInmunity = 1");
        if ($dbPlayer->rowCount() > 0) {
            $players = [];
            for ($i=0; $i < $dbPlayer->rowCount(); $i++) {
                $playerData = $dbPlayer->fetch();
                $players[] = new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"], $playerData["hasInmunity"]);
            }
            return $players;
        }
        return null;
    }

    public static function updateInmunityByNickName($nickName, $hasInmunity) {
        self::queryWithParameters("UPDATE player set hasInmunity = ? WHERE nickName = ?", array($hasInmunity, $nickName));
        return self::getByNickName($nickName);
    }

    public static function updateInmunity($playerId, $hasInmunity) {
        self::queryWithParameters("UPDATE player set hasInmunity = ? WHERE id = ?", array($hasInmunity, $playerId));
        return self::getById($playerId);
    }

    public static function getByNickNameAndGenderId($nickName, $genderId) {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
        if ($dbPlayer->rowCount() == 1) {
            $playerData = $dbPlayer->fetch();
            $player = new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"], $playerData["hasInmunity"]);
            return $player;
        }
        return null;
    }

    public static function getByNickName($nickName) {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ?", array($nickName));
        if ($dbPlayer->rowCount() == 1) {
            $playerData = $dbPlayer->fetch();
            $player = new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"], $playerData["hasInmunity"]);
            return $player;
        }
        return null;
    }

    public static function delete($nickName) {
        self::queryWithParameters("DELETE FROM player WHERE nickName = ?", array($nickName));
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "nickName" => $this->nickName,
            "genderId" => $this->genderId,
            "hasInmunity" => $this->hasInmunity,
            "levelId" => $this->levelId
        ];
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

    public function getHasInmunity() {
        return $this->hasInmunity;
    }

    public function getGames() {
        $dbGames = self::queryWithParameters("SELECT * FROM pickPlayer where playerId= ?",array($this->id));
        for ($i = 0; $i < $dbGames->rowCount(); $i++) {
            $dbGame = $dbGames->fetch();
            $game = Game::getById($dbGame['gameId']);
            $this->games->add($game);
        }
        return $this->games->jsonSerialize();
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
