<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/Player.php";

class User extends Player {

    private $id;
    private $userName;
    private $password;
    private $roleId;
    private $lastLogin;

    public function __construct($id, $userName, $password, $player) {
        parent::__construct($player->getId(), $player->getNickName(), $player->getGenderId(), $player->getLevelId());
        $this->id = $id;
        $this->userName = $userName;
        $this->password = $password;
    }

    public static function createUser($userName, $password, $nickName, $genderId) {
        $userNameSanitized = self::sanitize($userName);
        $passwordSanitized = self::sanitize($password);
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ? AND nickName = ?", array($userNameSanitized, self::sanitize($nickName)));
        if ($dbUser->rowCount() == 0) {
            $player = Player::createPlayer($nickName, $genderId);
            if ($player != null) {
                self::queryWithParameters("INSERT INTO user (userName, password, playerId) VALUES (?, ?, ?)", array($userNameSanitized, $passwordSanitized, $player->getId()));
                return self::getUser(self::lastInsertId());
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function getUser($userId){
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE id = ?", array($userId));
        if($dbUser->rowCount() == 1) {
            $userData = $dbUser->fetch();
            return new User($userData["id"], $userData["userName"], $userData["password"], self::getPlayer($userData["playerId"]));
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
