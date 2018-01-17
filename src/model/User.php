<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/Seriarizable.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "src/model/Player.php";

class User extends PersistentEntity implements Seriarizable {

    private $id;
    private $userName;
    private $password;
    private $roleId;
    private $lastLogin;
    /**
     * @var Player
     */
    private $player;

    public function __construct($id, $userName, $password, $player) {
        $this->id = $id;
        $this->userName = $userName;
        $this->password = $password;
        $this->player = $player;
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
            return new User($userData["id"], $userData["userName"], $userData["password"], Player::getPlayer($userData["playerId"]));
        } else {
            return null;
        }
    }

    public function toJson() {
        $return = [
            "id" => $this->id,
            "userName" => $this->userName,
            "password" => $this->password,
            "player" => $this->player->toJson(),
        ];
        return json_encode($return);
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

}
