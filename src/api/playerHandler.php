<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/PlayerAPI.php";


switch ($_GET["action"]){
    default: {
        return json_encode(["status" => "error"]);
    }
    case "get":
        get();
        break;
    case "getGames":
        getGames();
        break;
    case "putPlayerTeam":
        putPlayerTeam();
}


function getGames() { // Add type later
    if(isset($_GET['id'])){
        if($games = PlayerAPI::playerGames($_GET['id'])){
            echo json_encode(["status" => "success","games" => $games]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    }

}

function putPlayerTeam() {
    if(isset($_GET['id']) && isset($_GET['gameId']) && isset($_GET['teamId'])) {
        if($movement= PlayerAPI::putTeam($_GET['id'], $_GET['teamId'], $_GET['gameId'])) {
            echo json_encode(["status" => "success", "player" => $movement]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    }
}

function get() {
    if(isset($_GET['id'])) {
        if($player = PlayerAPI::getById($_GET['id'])) {
            echo json_encode(["status" => "success", "player" => $player->toArray()]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    }
}