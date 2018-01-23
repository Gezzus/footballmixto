<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/GameAPI.php";

if(isset($_GET['id'])){
    $game = GameAPI::get($_GET['id']);
    if($game != null || empty($game)) {
        echo $game->toJson();
    } else {
        echo json_encode(["status" => "failed"]);
    }
} else {
    echo json_encode(["status" => "empty"]);
}


?>
