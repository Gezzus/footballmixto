<?php

    include_once "../config/Database.php";

	class Player extends PersistentEntity implements Seriarizable {

		private $id;
		private $nickName;
		private $genderId;
		private $levelId;

		public function __construct($id, $nickName, $genderId, $levelId) {
            $this->id = $id;
            $this->nickName = $nickName;
            $this->genderId = $genderId;
            $this->levelId = $levelId;
        }

        private static function create($nickName, $genderId) {
			$dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array($nickName, $genderId));
            if($dbPlayer->rowCount() == 0) {
                self::queryWithParameters("INSERT INTO player(nickName, genderId) VALUES(?, ?)", array($nickName, $genderId));
				return self::get(self::lastInsertId());
			} else{
				return null;
			}
		}

        private static function get($playerId){
            $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE id = ?", array($playerId));
            if($dbPlayer->rowCount() == 1) {
                $playerData = $dbPlayer->fetch();
                return new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"]);
            } else {
                return null;
            }
        }

        public function toJson() {
            $return = [
                "id" => $this->id,
                "nickName" => $this->nickName,
                "genderId" => $this->genderId,
                "levelId" => $this->levelId
            ];
            return json_encode($return);
        }

    }
?>

