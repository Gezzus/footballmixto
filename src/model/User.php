<?php


include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Player.php";

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

    public static function createUser($userName, $password, $nickName, $genderId, $skillId) {
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ?", array($userName));
        if ($dbUser->rowCount() == 0) {
            $dbPlayer = Player::get($nickName, $genderId);
            if($dbPlayer != null) {
                $userExistsCheck = self::queryWithParameters("SELECT * FROM user WHERE playerId = ?", array($dbPlayer->getId()));
               // echo "This dbPlayer->getId() = ".$dbPlayer->getId();
                if($userExistsCheck->rowCount() == 0) {
                    self::queryWithParameters("INSERT INTO user (userName, password, playerId, roleId, lastLogin) VALUES (?, MD5(?), ?, 1, NOW())", array($userName, $password, $dbPlayer->getId()));
                    $newUser = self::getById(self::lastInsertId());
                    return $newUser;
                } else {
                    return null;
                }
            } else {
                $player = Player::create($nickName, $genderId, $skillId);
                if ($player != null) {
                    self::queryWithParameters("INSERT INTO user (userName, password, playerId, roleId, lastLogin) VALUES (?, ?, ?, 1, NOW())", array($userName, $password, $player->getId()));
                    $newUser = self::getById(self::lastInsertId());
                    return $newUser;
                } else {
                    return null;
                }
            }
        } else {
            return null;
        }
    }

    public static function getUser($userName, $password){
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ? AND password = ?", array($userName, md5($password)));
        if($dbUser->rowCount() == 1) {
            $userData = $dbUser->fetch();
            return new User($userData["id"], $userData["userName"], $userData["password"], Player::getById($userData["playerId"]));
        } else {
            return null;
        }
    }

    public static function getById($userId){
        $dbUser = self::queryWithParameters("SELECT * FROM user WHERE id = ?", array($userId));
        if($dbUser->rowCount() == 1) {
            $userData = $dbUser->fetch();
            return new User($userData["id"], $userData["userName"], $userData["password"], Player::getById($userData["playerId"]));
        } else {
            return null;
        }
    }

    public function toArray() {
        $return = [
            "id" => $this->id,
            "userName" => $this->userName,
            "password" => $this->password,
            "player" => $this->player->toJson(),
        ];
        return $return;
    }

    public function toJson() {
        return json_encode($this->toArray());    
    }

    public function getUserName() {
        return $this->userName;
    }
    
    public function getId() {
        return $this->id;
    }
    

    public function setUserName($userName) {
        $this->userName = $userName;
    }

}


?>
