<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/SerializableCollection.php";

class Team extends PersistentEntity implements Seriarizable {

    private $id;
    private $name;
    #private $size;
    private $players;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->players = new SerializableCollection();
    }

    public function toArray() {
        $return = [
            "id" => $this->id,
            "name" => $this->name,
            "players" => $this->players->toArray(),
        ];
        return $return;
    }
    
    public function toJson() {
        return json_encode($this->toArray());
    }

    public static function createTeam($name,$size) {
        $dbTeam = self::queryWithParameters("SELECT * FROM team WHERE name = ? AND size = ?", array($name, $size));
        if($dbTeam->rowCount() == 0) {
            self::queryWithParameters("INSERT INTO team (name, size) VALUES(?, ?)", array($name, $size));
        return(self::getTeam(self::lastInsertId()));
        } else {
            return null;
        }
    }

    /*public static function getPlayersData($gameId, $id) {
        $dbPlayersInfo = self::queryWithParameters("SELECT playerId FROM pickPlayer LEFT JOIN player on teamId=? WHERE gameId= ?",array($id, $gameId));
        if($dbPlayersInfo->rowCount() != 0) {
            $playersInfo = $dbPlayersInfo->fetchAll();
            return $playersInfo;
        } else {
            return null;
        }
    }*/


    public static function getById($gameId, $id) {
        $dbTeam = self::queryWithParameters("SELECT * FROM team WHERE id= ?",array($id));
        if($dbTeam->rowCount() == 1) {
            $teamData = $dbTeam->fetch();
            $team = new Team($teamData["id"], $teamData["name"]);
            $team->getPlayers($gameId);
            #var_dump($team);
            return $team;
        } else {
            return null;
        }
    }

    public static function deleteTeam($id) {
        self::queryWithParameters("DELETE FROM team WHERE id = ?", array($id));
    }

    public function getId() {
        return $this->id;
    }


    public function getPlayers($gameId) {
        $dbTeam = $this->queryWithParameters("SELECT * FROM pickPlayer WHERE gameId = ? AND teamId = ?", array($gameId, $this->id));
        if($dbTeam->rowCount() != 0) {
            for ($i=0; $i < $dbTeam->rowCount(); $i++) {
                $teamData = $dbTeam->fetch();
                $dbPlayer = $this->queryWithParameters("SELECT * FROM player WHERE id = ?", array($teamData["playerId"]));
                $playerData = $dbPlayer->fetch();
                $player = new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"]);
                $this->players->add($player);
            }
        } else {
            return null;
        }
    }

    public function putPlayer($playerId) {
        $player = Player::getPlayerById($playerId);
        $this->players->add($player);
        return $playerId;
    }

    public function removePlayer($teamId, $gameId, $playerId) {

    }

    public function transferPlayer($playerId) {
        $player = Player::getById($playerId);
        $this->players->add($player);
        return $playerId;
    }

}
