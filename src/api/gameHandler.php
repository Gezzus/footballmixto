<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/GameAPI.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/PlayerAPI.php";

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        default:
            echo json_encode(["status" => "failed"]);
        case "retrieve":
            retrieveGame();
            break;
        case "remove":
            removePlayer();
            break;
        case "add":
            addPlayer();
            break;
        case "transfer":
            transferPlayer();
            break;
        case "createGame":
            createGame();
            break;
        case "changeStatus":
            changeStatus();
            break;
        case "delete":
            deleteGame();
            break;
    }
}

function retrieveGame() {
    if(isset($_GET['id'])) {
        $game = GameAPI::get($_GET['id']);
        if($game != null && !empty($game)) {
            echo $game->toJson();
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}

function createGame() {
    if(isset($_GET['typeId']) && isset($_GET['date']) && isset($_GET['time'])) {
        $gameId = GameAPI::create($_GET['typeId'], $_GET['date'], $_GET['time']);
        if($gameId != null) {
            $game = GameAPI::get($gameId);
            echo json_encode(["status" => "success", "game" => $game->toArray()]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}



function addPlayer() {
    if (isset($_GET['id'])) {
        if (isset($_GET['playerId'])) {
            $addition = GameAPI::addPlayer($_GET['id'], $_GET['playerId']);
            if ($addition) {
               $player = Player::getById($_GET['playerId']);
               echo json_encode(["status" => "success", "player" => $player->toArray()]);
            } else {
                echo json_encode(["status" => "failed"]);
            }
        } else if (isset($_GET['nickName']) && isset($_GET['genderId'])) {
            $player = PlayerAPI::get($_GET['nickName'], $_GET['genderId']);
            if($player === null) {
                $newPlayer = PlayerAPI::create($_GET['nickName'], $_GET['genderId'],"3");
                if($newPlayer != null) {
                    $addition = GameAPI::addPlayer($_GET['id'], $newPlayer->getId());
                    if ($addition != null && !empty($addition)) {
                        if($addition.status === "success"){
                            echo json_encode(["status" => "success", "player" => $newPlayer->toArray()]);
                        } else {
                            echo json_encode(["status" => "failed"]);
                        }
                    } else {
                        echo json_encode(["status" => "failed"]);
                    }
                } else {
                    echo json_encode(["status" => "error"]);
                }
            } else {
                $addition = GameAPI::addPlayer($_GET['id'], $player->getId());
                if ($addition != null && !empty($addition)) {
                    echo json_encode(["status" => "success", "player" => $player->toArray()]);
                } else {
                echo json_encode(["status" => "failed"]);
                }
            }
        } else {
            echo json_encode(["status" => "failed"]);//here
        }
    } else {
        echo json_encode(["status" => "error"]);
    }
}

function getPlayer() {
    if (isset($_GET['id'])) {
        $player = PlayerAPI::getById($_GET['id']);
        if ($player != null && !empty($player)) {
            echo $player->toJson();
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}

function removePlayer() {
    if (isset($_GET['id']) && isset($_GET['playerId'])) {
        $player = PlayerAPI::getById($_GET['playerId']);
        $removal = GameAPI::removePlayer($_GET['id'], $player->getId());
        if ($removal != null && !empty($removal)) {
            echo json_encode(["status" => "success","playerId" => $removal]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "failed"]);
    }
}

function transferPlayer() {
    if(isset($_GET['gameId']) && isset($_GET['teamId']) && isset($_GET['playerId'])) {
        if($_GET['teamId'] == null) {
            if($player = GameAPI::transferPlayer($_GET['gameId'], $_GET['playerId'], null)){
                echo json_encode(["status" => "success","player" => $player, "teamId" => "Teamless"]);
            } else {
                echo json_encode(["status" => "failed"]);
            }
        } else {
            if($player = GameAPI::transferPlayer($_GET['gameId'], $_GET['playerId'], $_GET['teamId'])){
                echo json_encode(["status" => "success","player" => $player, "teamId" => $_GET['teamId']]);
            } else {
                echo json_encode(["status" => "failed"]);
            }
        }
    } else {
        echo json_encode(["status" => "failed"]);
    }
}

function changeStatus() {
    if(isset($_GET['id']) && isset($_GET['status'])) {
        if($game = GameAPI::putGameStatus($_GET['id'],$_GET['status'])) {
            echo json_encode(["status" => "success","game" => $game]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    }
}

function deleteGame() {
    if(isset($_GET['id'])) {
        if ($game = GameAPI::delete($_GET['id'])) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    }
}