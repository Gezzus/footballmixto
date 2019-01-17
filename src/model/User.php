<?php

namespace App\Model;

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


    public function __construct($id, $userName, $password, $roleId, $player) {
        $this->id = $id;
        $this->userName = $userName;
        $this->password = $password;
        $this->roleId = $roleId;
        $this->player = $player;
    }

    public static function create($userName, $password, $nickName, $genderId, $skillId) {
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ?", array($userName));
        if ($dbUser->rowCount() == 0) {
            $dbPlayer = Player::get($nickName, $genderId);
            if($dbPlayer != null) {
                return self::createUserIfNeeded($userName, $password, $dbPlayer->getId());
            } else {
                $player = Player::create($nickName, $genderId, $skillId);
                if ($player != null) {
                    return self::createUser($userName, $password, $player->getId());
                } else {
                    return null;
                }
            }
        } else {
            return null;
        }
    }

    private static function createUserIfNeeded($userName, $password, $playerId) {
        $userExistsCheck = self::queryWithParameters("SELECT * FROM user WHERE playerId = ?", array($playerId));
        if ($userExistsCheck->rowCount() == 0) {
            return self::createUser($userName, $password, $playerId);
        } else {
            return null;
        }
    }

    private static function createUser($userName, $password, $playerId) {
        self::queryWithParameters("INSERT INTO user (userName, password, playerId, roleId, lastLogin) VALUES (?, MD5(?), ?, 1, NOW())", array($userName, $password, $playerId));
        $newUser = self::getById(self::lastInsertId());
        return $newUser;
    }

    public static function getUser($userName, $password){
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ? AND password = ?", array($userName, md5($password)));
        if($dbUser->rowCount() == 1) {
            $userData = $dbUser->fetch();
            return new User($userData["id"], $userData["userName"], $userData["password"], $userData["roleId"], Player::getById($userData["playerId"]));
        } else {
            return null;
        }
    }

    public static function getById($userId){
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE id = ?", array($userId));
        if($dbUser->rowCount() == 1) {
            $userData = $dbUser->fetch();
            return new User($userData["id"], $userData["userName"], $userData["password"], $userData["roleId"], Player::getById($userData["playerId"]));
        } else {
            return null;
        }
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "userName" => $this->userName,
            "password" => $this->password,
            "player" => $this->player->toJson(),
        ];
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getId() {
        return $this->id;
    }

    public function getRoleId() {
        return $this->roleId;
    }

    public function getPlayerId(){
        return $this->player->getId();
    } // Player is private, I need this function

    public function setUserName($userName) {
        $this->userName = $userName;
    }

}
