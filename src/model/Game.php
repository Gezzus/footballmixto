<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
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

    function __construct($id, $date, $typeId, $status, $doodleUrl){
        $this->id = $id;
        $this->date = $date;
        $this->typeId = $typeId;
        $this->status = $status;
        $this->doodleUrl = $doodleUrl;
        $this->teams = [];
        $this->teamless = [];
    }
    
    public function toArray() {
        
        $indexedTeams = array();
        foreach ($this->teams as $row) {
            $indexedTeams[] = $row->toArray();
        }
        
        $indexedTeamless = array();
        if(!empty($this->teamless)) {
            foreach ($this->teamless as $row) {
            $indexedTeamless[] = $row->toArray();
           }
        }

        $return = [
            "id" => $this->id,
            "date" => $this->date,
            "typeId" => $this->typeId,
            "status" => $this->status,
            "teams" => $indexedTeams,
            "teamless" => $indexedTeamless
        ];
        return $return;
    }

    public function toJson() {
        
        return json_encode($this->toArray());
    }
    
    public static function getGameData($typeId) {
        $dbGameInfo = self::queryWithParameters("SELECT * FROM gameType LEFT JOIN genderByGameType on gameTypeId=id  WHERE id= ?",array($typeId));
        if($dbGameInfo->rowCount() != 0) {
            $gameInfo = $dbGameInfo->fetchAll();
            return $gameInfo;
        } else {
            return null;
        }
    }
    
    public static function getGameTeamless($id) {
        $dbPlayersInfo = self::queryWithParameters("SELECT playerId as 'playerId' FROM pickPlayer WHERE gameId= ?  AND teamId IS NULL",array($id));
        if($dbPlayersInfo->rowCount() != 0) {
            $playersInfo = $dbPlayersInfo->fetchAll();
            #var_dump($playersInfo);
            return $playersInfo;
        } else {
            return null;
        }
    }

    
    public static function create($date, $typeId, $doodleUrl) {
        $gameInfo = self::getGameData($typeId);
        if($gameInfo == null){
            return null;
        } else {
            self::queryWithParameters("INSERT INTO game(date, typeId, doodleurl, status) VALUES(?, ?, ?, '0')",array($date, $typeId, $doodleUrl));
            //var_dump(self::queryErrorInfo());
            $gameId = self::lastInsertId();
            if($gameId != null){
                
                $game = new Game($gameId, $date, $typeId, '0', $doodleUrl);
                for ($i = 0; $i < $gameInfo[0]['teamAmount']; $i++) {
                  $team = Team::getTeam($i+1);
                  array_push($game->teams,$team);
                }
                var_dump($game);
                return $game;
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
            for ($i = 0; $i < $gameInfo[0]['teamAmount']; $i++) {
                $teams[$i] = Team::getById($id, $i+1);
                array_push($game->teams,$teams[$i]);
            }
            
            $gamePlayers = self::getGameTeamless($id);
            if($gamePlayers != null) {
                for ($i = 0; $i < count($gamePlayers); $i++) {
                    $player = Player::getById($gamePlayers[$i]["playerId"]);
                    array_push($game->teamless,$player);
                }    
            }
            return $game;   
        }
    }
    
    public static function getByOther($other,$otherValue) {
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
        $dbPlayer = self::queryWithParameters("INSERT INTO pickPlayer(gameId, playerId) VALUES(?, ?)",array($this->id, $playerId));
        $player = Player::getById($playerId);
        array_push($this->teamless,$player);
        return $playerId;
    }
    

    public function getTeam($teamId) {
        for ($i=0; $i < count($this->teams); $i++) { 
            if($this->teams[$i]->getId() == $teamId) {
                return $this->teams[$i];
            }    
        }
    }   

    
    
}
