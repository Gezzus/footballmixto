<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/Seriarizable.php";

class Team extends PersistentEntity implements Seriarizable {

    private $id;
    private $name;
    private $size;
    #private $players;

    function __construct($id, $name, $size) {

    }

    public static function createTeam($name,$size) {
        $dbTeam = self::queryWithParameters("SELECT * FROM team WHERE name = ? AND size = ?", array(self::sanitize($name), $size));
        if($dbTeam->rowCount() == 0) {
            self::queryWithParameters("INSERT INTO team (name, size) VALUES(?, ?)", array(self::sanitize($name), $size));
        #var_dump(self::lastInsertId());
        return(self::getTeam(self::lastInsertId));
        } else {
            return null;
        }
    }

    public static function getTeam($teamId) {
        $dbTeam = self::queryWithParameters("SELECT * FROM team WHERE id = ?", array($teamId));
        if($dbTeam->rowCount() == 1) {
            $teamData = $dbTeam->fetch();
            return new Team($teamData["id"], $teamData["name"], $teamData["size"]);
        } else {
            return null;
        }
    }

    public static function deleteTeam($id) {
        self::queryWithParameters("DELETE FROM team WHERE id = ?", array(self::sanitize($id)));
    }


    public function toJson() {
        $return = [
        "id" => $this->id,
        "name" => $this->nickName,
        "size" => $this->genderId
        ];
        return json_encode($return);
    }

    public function getId() {
        return $this->id;
    }


    public function getPlayers($gameId) {
        $dbTeam = $this->queryWithParameters("SELECT * FROM pickPlayer WHERE gameId = ? AND teamId = ?", array($gameId, $this->id));
        if($dbTeam->rowCount() != 0) {
            $teamData = $dbTeam->fetch();
            for ($i=0; $i < $dbTeam->rowCount(); $i++) {

                $dbPlayer = $this->queryWithParameters("SELECT * FROM player WHERE id = ?", array($this->sanitize($dbTeam["playerId"])));
                $playerData = $dbPlayer->fetch();
                $playersData[$i] = new Player($playerData["id"], $playerData["nickName"], $playerData["gender"], $playerData["levelId"]);
            }
            return json_encode($playersData);
        } else {
            return null;
        }
    }

    public function putPlayer($gameId, $playerId) {
        $playersData = $this->getPlayers($gameId);
        if(count($playersData) < $this->size) {
            for ($i=0; $i < count($playersData); $i++) {
                if($playersData[$i]["id"] == $playerId) {
                    return null;
                } else{
                    $dbPickPlayer = $this->queryWithParameters("INSERT INTO pickPlayer (playerId, teamId, gameId) values(?, ?, ?)",array($this->sanitize($playerId), $this->id, $this->sanitize($gameId)));
            }
            return true;
            }
        } else {
            return null;
        }
    }

    public function removePlayer($teamId, $gameId, $playerId) {

    }


}

?>
