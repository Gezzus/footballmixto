<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/GameAPI.php";

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        default:
            echo json_encode(["status" => "failed"]);
        case "add":
            echo addPlayer();
            break;
            
        case "retrieve":
            echo retrieveGame();
            break;
    }
}

function retrieveGame() {
    if(isset($_GET['id'])) {
        $game = GameAPI::get($_GET['id']);
        if($game != null || empty($game)) {
            echo $game->toJson();
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}

function addPlayer() {
    if(isset($_GET['gameId']) && isset($_GET['nickName']) && isset($_GET['gender'])) {
            $player = GameAPI::getPlayer($nickName, $gender);
            $addition = GameAPI::addPlayer($_GET['gameId'],$player->getId());
            if($addition != null || empty($addition)) {
                echo $addition->toJson();
            } else {
                echo json_encode(["status" => "failed"]);
            }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}

function getPlayer() {
    if(isset($_GET['id'])) {
        $player = GameAPI::getPlayerById($_GET['id']);
        if($player != null || empty($player)) {
            echo $player->toJson();
        } else {
            echo json_encode(["status" => "failed"]);
        } 
    } else {
        echo json_encode(["status" => "empty"]);
    }
}


?>
