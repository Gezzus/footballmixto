<?php

namespace App\Model;

class Game extends PersistentEntity implements Seriarizable {

    private $id;
    private $date;
    private $type;
    private $status;
    private $teams;
    private $teamless;
    private $doodleUrl;

    function __construct($id, $date, $type, $status, $doodleUrl) {
        $this->id = $id;
        $this->date = $date;
        $this->type = $type;
        $this->status = $status;
        $this->doodleUrl = $doodleUrl;
        $this->teams = new SerializableCollection();
        $this->teamless = new SerializableCollection();
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "date" => $this->date,
            "type" => $this->type->jsonSerialize(),
            "status" => $this->status,
            "teams" => $this->teams->jsonSerialize(),
            "teamless" => $this->teamless->jsonSerialize()
        ];
    }

    public static function create($date, $typeId, $doodleUrl) {
        $gameInfo = GameType::getById($typeId);
        if($gameInfo == null) {
            self::queryWithParameters("INSERT INTO game(date, typeId, doodleurl, status) VALUES(?, ?, ?, 0)", array($date, $typeId, $doodleUrl));
            return Game::getById(self::lastInsertId());
        }
        return null;
    }

    public static function getAllByStatus($status, $limit) {
        $rows = self::queryWithParameters("SELECT * FROM game WHERE status=? LIMIT 10" , array(intval($status)));
        $events = array();
        for($i = 0; $i < $rows->rowCount(); $i++) {
            $events[] = Game::getById($rows->fetch()['id']);
        }
        return $events;
    }

    public static function getById($id) {
        $dbGame = self::queryWithParameters("SELECT * FROM game WHERE id = ?", array(intval($id)));
        if($dbGame->rowCount() == 0){
            return null;
        } else {
            $dbGameRow = $dbGame->fetch();
            $gameType = GameType::getById($dbGameRow['typeId']);
            $game = new Game($dbGameRow['id'], $dbGameRow['date'], $gameType, $dbGameRow['status'], $dbGameRow['doodleurl']);
            for ($i = 0; $i < $gameType->getTeamsAmount(); $i++) {
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

    public static function getGameTeamless($id) {
      $dbPlayersInfo = self::queryWithParameters("SELECT playerId FROM pickPlayer WHERE gameId = ?  AND teamId IS NULL", array($id));
      if($dbPlayersInfo->rowCount() != 0) {
        return $dbPlayersInfo->fetchAll();
      }
      return null;
    }

    public function delete() {
        self::queryWithParameters("DELETE FROM pickPlayer WHERE gameId= ?", array($this->id));
        self::queryWithParameters("DELETE FROM game WHERE id = ?", array($this->id));
        return true;
    }


    public function addPlayer($playerId) { // Teamless
        $player = Player::getById($playerId);
        $dbPickPlayer = $this->queryWithParameters("SELECT * FROM pickPlayer WHERE gameId = ? AND playerId = ?", array($this->id, $playerId));
        if($dbPickPlayer->rowCount() != 0) {
            return null;
        } else {
            $this->queryWithParameters("INSERT INTO pickPlayer(gameId, playerId, timeStamp) VALUES(?, ?, NOW())", array($this->id, $playerId));
            $this->teamless->add($player);
            return $player;
        }
    }

    public function removePlayer($playerId) {
        $player = Player::getById($playerId);
        $dbPickPlayer = $this->queryWithParameters("SELECT * FROM pickPlayer WHERE gameId = ? AND playerId = ?", array($this->id, intval($playerId)));
        if($dbPickPlayer->rowCount() == 0) {
            return null;
        } else {
            $this->queryWithParameters("DELETE FROM pickPlayer WHERE gameId= ? AND playerId= ?", array($this->id, intval($playerId)));
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

    public function putStatus($status) {
        $this->queryWithParameters("UPDATE game SET status=? WHERE id=?", array($status,$this->id));
        $this->status = $status;
        return $this;
    }
}
