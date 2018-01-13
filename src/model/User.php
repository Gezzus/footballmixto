<?php

	class User extends Player implements Seriarizable {

	    private $playerId;
        private $id;
	    private $userName;
	    #private $password;

	    public function __construct($id, $userName) {
            $this->id = $id;
            $this->nickName = $userName;
            #$this->genderId = $genderId;
            #$this->levelId = $levelId;
        }

        private static function create($userName,$nickName) {
			

			$dbUser = self::queryWithParameters("SELECT * FROM user WHERE userName = ? AND nickName = ?", array($userName, $nickName));
            if($dbUser->rowCount() == 0) {
            		$dbPlayer = self::queryWithParameters("SELECT * FROM user WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
		            if($dbPlayer->rowCount() == 0) {
		                self::queryWithParameters("INSERT INTO player(nickName, genderId) VALUES(?, ?)", array($nickName, $genderId));
						$playerId = self::get(self::lastInsertId());

						self::queryWithParameters("INSERT INTO user(userName, password, playerId, ) VALUES(?, ?, ?)", array($userName, $password, $playerId));
						return self::get(self::lastInsertId());
					} else{
						return null;
					}
                
			} else{
				return null;
			}	

		}

        private static function get($userId){
            $dbPlayer = self::queryWithParameters("SELECT * FROM user WHERE id = ?", array($userId));
            if($dbPlayer->rowCount() == 1) {
                $playerData = $dbPlayer->fetch();
                return new Player($playerData["id"], $playerData["playerId"], $playerData["username"], $playerData["password"]);
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

        public function getUserName()
        {
            return $this->userName;
        }

        public function setUserName($userName)
        {
            $this->userName = $userName;
            #DBQueryHere??
        }


		public function retrieve(){
			return $this;
		}

        
    }