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
        foreach ($this->teamless as $row) {
            $indexedTeamless[] = $row->toArray();
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
    
    
    public static function create($date, $typeId, $doodleUrl) {
        $gameInfo = self::getGameData($typeId);
        self::queryWithParameters("INSERT INTO game(date, typeId, doodleurl, status) VALUES(?, ?, ?, '0')",array($date, $typeId, $doodleUrl));
        $gameId = self::lastInsertId();
        if($gameId != null){
            
            $game = new Game($gameId, $date, $typeId, '0', $doodleUrl);
            for ($i = 0; $i < $gameInfo[0]['teamsAmount']; $i++) {
              $teams[$i] = Team::getTeam($i+1);
              array_push($game->teams,$teams[$i]);
            }
            var_dump($game);
            return $game;
        }
        else { 
            return null;
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
                $teams[$i] = Team::getTeam($i+1);
                array_push($game->teams,$teams[$i]);
            }
            var_dump($game);
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
    
    
    public function addPlayer($playerId) {
        $dbPlayer = self::queryWithParameters("INSERT INTO pickPlayer(gameId, playerId) VALUES(?, ?)",array($this->id, $playerId));
        var_dump(self::queryErrorInfo());
        $player = Player::getPlayerById($playerId);
        array_push($this->teamless,$player);
        var_dump($this->teamless);
        return $playerId;
    }
    
    /*public function assignPlayer($playerId,$teamId) {
       $dbAssignPlayer = self::queryWithParameters("UPDATE pickPlayer")
    }*/
    
    
}
