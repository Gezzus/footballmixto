<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/SerializableCollection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Game.php";

class Events extends PersistentEntity implements Seriarizable {

    private $games;

    function __construct() {
        $this->games = new SerializableCollection();
    }

    public function toArray() {
        $return = [
            "games" => $this->games->toArray()
        ];
        return $return;

    }

    public function toJson() {
        return json_encode($this->toArray());
    }

    public static function getByType($status, $amount, $typeId) {
        $dbEvents = self::queryWithParameters("SELECT * FROM game WHERE status=? AND typeId= ? LIMIT ?", array($status, $typeId, $amount));
        $events = Events::arrangeEvents($dbEvents);
        return $events;
    }

    public static function get($status, $amount) {
        $dbEvents = self::queryWithParameters("SELECT * FROM game WHERE status=? LIMIT " . $amount, array($status));
        $events = Events::arrangeEvents($dbEvents);
        return $events;
    }

    public static function arrangeEvents($queryObject) {
        if ($queryObject->rowCount() != 0) {
            $events = new Events();
            for($i = 0; $i < $queryObject->rowCount(); $i++) {
                $dbGame = $queryObject->fetch();
                $events->games->add(Game::getById($dbGame['id']));
            }
            return $events;
        } else {
            return null;
        }
    }


}
