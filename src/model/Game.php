<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/SerializableCollection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Team.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Player.php";

class Game extends PersistentEntity implements Seriarizable {

    private $id;
    private $date;
    private $typeId;
    private $status;
    private $teams;
    private $teamless;
    private $doodleUrl;

    function __construct($id, $date, $typeId, $status, $doodleUrl) {
        $this->id = $id;
        $this->date = $date;
        $this->typeId = $typeId;
        $this->status = $status;
        $this->doodleUrl = $doodleUrl;
        $this->teams = new SerializableCollection();
        $this->teamless = new SerializableCollection();
    }
    
    public function toArray() {
        $return = [
            "id" => $this->id,
            "date" => $this->date,
            "typeId" => $this->typeId,
            "status" => $this->status,
            "teams" => $this->teams->toArray(),
            "teamless" => $this->teamless->toArray()
        ];
        return $return;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
    
    public static function getGameData($typeId) {
        $dbGameInfo = self::queryWithParameters("SELECT * FROM gameType LEFT JOIN genderByGameType on gameTypeId=id  WHERE id= ?", array($typeId));
        if($dbGameInfo->rowCount() != 0) {
            $gameInfo = $dbGameInfo->fetchAll();
            return $gameInfo;
        } else {
            return null;
        }
    }
    
    public static function getGameTeamless($id) {
        $dbPlayersInfo = self::queryWithParameters("SELECT playerId FROM pickPlayer WHERE gameId = ?  AND teamId IS NULL", array($id));
        if($dbPlayersInfo->rowCount() != 0) {
            $playersInfo = $dbPlayersInfo->fetchAll();
            return $playersInfo;
        } else {
            return null;
        }
    }

    
    public static function create($date, $typeId, $doodleUrl) {
        $gameInfo = self::getGameData($typeId);
        if($gameInfo == null) {
            return null;
        } else {
            self::queryWithParameters("INSERT INTO game(date, typeId, doodleurl, status) VALUES('".$date."', ?, ?, 0)", array($typeId, $doodleUrl));
            $gameId = self::lastInsertId();
            if($gameId != null){   
                return $gameId;
            }
            else { 
                return null;
            }   
        }
    }
    
    public static function getById($id) {
        $dbGame = self::queryWithParameters("SELECT * FROM game WHERE id = ?", array($id));
        if($dbGame->rowCount() == 0){
            return null;
        } else {
            $dbGameRow = $dbGame->fetch();
            $game = new Game($dbGameRow['id'], $dbGameRow['date'], $dbGameRow['typeId'], $dbGameRow['status'], $dbGameRow['doodleurl']); // TODO TEAMLESS
            $gameInfo = self::getGameData($dbGameRow['typeId']);
            for ($i = 0; $i < $gameInfo[0]['teamsAmount']; $i++) {
                $teams[$i] = Team::getById($id, $i+1);
                $game->teams->add($teams[$i]);
            }
            
            $gamePlayers = self::getGameTeamless($id);
            if($gamePlayers != null) {
                for ($i = 0; $i < count($gamePlayers); $i++) {
                    $player = Player::getById($gamePlayers[$i]["playerId"]);
                    $game->teamless->add($player);
                }    
            }
            return $game;   
        }
    }
    
    public static function getByOther($other, $otherValue) {
        $dbGames = self::queryWithParameters("SELECT * FROM game WHERE ? = ?", array($other,$otherValue));
        if($dbGames->rowCount() == 0){
            return null;
        } else {
            $games = $dbGames->fetchAll();
            return $games;
        }
    }
    
    public function delete() {
        self::queryWithParameters("DELETE FROM game WHERE id = ?", array($this->id));
    }
    
    
    public function addPlayer($playerId) { // Teamless
        $player = Player::getById($playerId);
        $dbPickPlayer = $this->queryWithParameters("SELECT * FROM pickPlayer WHERE gameId = ? AND playerId = ?", array($this->id, $playerId));
        if($dbPickPlayer->rowCount() != 0) {
            return null;
        } else {
            $this->queryWithParameters("INSERT INTO pickPlayer(gameId, playerId) VALUES(?, ?)", array($this->id, $playerId));
            $this->teamless->add($player);
            return $player;
        }
    }

    public function removePlayer($playerId) {
        $player = Player::getById($playerId);
        $dbPickPlayer = $this->queryWithParameters("SELECT * FROM pickPlayer WHERE gameId = ? AND playerId = ?", array($this->id, $playerId));
        if($dbPickPlayer->rowCount() == 0) {
            return null;
        } else {
            $this->queryWithParameters("DELETE FROM pickPlayer WHERE gameId= ? AND playerId= ?", array($this->id, $playerId));
            $this->teamless->remove($player);
            return $playerId;
        }
    }

    public function getTeams() {
        return $this->teams;
    }

    public function getTeam($teamId) {
        for ($i=0; $i < $this->teams->size(); $i++) {
            #echo "Comparing: ".$this->teams->get($i)->getId()." with ".$teamId;
            if($this->teams->get($i)->getId() == $teamId) {
                return $this->teams->get($i);
            }    
        }
        return null;
    }
    
}
