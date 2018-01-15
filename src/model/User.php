<?php

include("Player.php");

class User extends Player implements Seriarizable {

    private $id;
    private $userName;
    private $password;
    private $roleId;
    private $lastLogin;

    public function __construct($id, $userName, $password, $playerId) {
        $this->id = $id;
        $this->userName = $userName;
        $this->password = $password;
        $this->genderId = $playerId;
        #$this->levelId = $levelId;
    }

    public static function createUser($userName,$password,$nickName,$genderId) {
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ? AND nickName = ?", array($userName, $nickName));
        if ($dbUser->rowCount() == 0) {
            $dbPlayer = self::queryWithParameters("SELECT * FROM user WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
            if ($dbPlayer->rowCount() == 0) {
                self::queryWithParameters("INSERT INTO player(nickName, genderId) VALUES(?, ?)", array($nickName, $genderId));
                $playerId = self::lastInsertId();

                self::queryWithParameters("INSERT INTO user(userName, password, playerId) VALUES(?, ?, ?)", array($userName, $password, $playerId));
                return self::lastInsertId();
            } else {
                return null;
            }

        } else {
            return null;
        }
    }

    private static function getUser($userName,$password){
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE id = ? LIMIT 1", array(self::sanitize($userName),self::sanitize($password)));
        if($dbUser->rowCount() == 1) {
            $UserData = $dbUser->fetch();
            $User = new User($UserData["id"], $UserData["userName"], $UserData["password"], $UserData["playerId"]);
            return $User->toJson();
        } else {
            return null;
        }
    }

    public function toJson() {
        $return = [
            "id" => $this->id,
            "playerId" => $this->playerId,
            "userName" => $this->userName,
            "password" => $this->password
        ];
        return json_encode($return);
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
        #DBQueryHere??
    }

    public function retrieve(){
        return $this;
    }


}