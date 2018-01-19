<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";

class Game extends PersistentEntity implements Seriarizable {

    private $id;
    private $date;
    private $typeId;
    private $status;
    private $teams;
    private $teamless;
    private $doodleUrl;

    function __construct($id, $date, $typeId, $status, $doodleUrl){
        $this->id = $id;
        $this->date = $date;
        $this->typeId = $typeId;
        $this->status = $status;
        $this->doodleUrl = $doodleUrl;
        $this->teams = array();
        $this->teamless = array();
    }

    public function addTeam($teamId){
        array_push($this->teams, $teamId);
    }

    public function removeTeam($teamId){
        $teamPosition = array_search($teamId, $this->teams);
        unset($this->teams[$teamPosition]);
    }

    //TODO encode array objects
    public function toJson() {
        $return = [
            "id" => $this->id,
            "date" => $this->date,
            "typeId" => $this->typeId,
            "status" => $this->status,
            "teams" => $this->teams,
            "teamless" => $this->teamless
        ];
        return json_encode($return);
    }
}
