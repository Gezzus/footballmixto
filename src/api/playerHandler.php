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
}

function get() {
    #ToDo;
}

function getGames() { // Add type later
    if($games = PlayerAPI::playerGames($_GET['id'])){
        echo json_encode(["status" => "success","games" => $games]);
    } else {
        echo json_encode(["status" => "failed"]);
    }
}
