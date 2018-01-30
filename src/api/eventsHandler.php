<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/EventsAPI.php";

if(isset($_GET['status']) && isset($_GET['amount'])) {
    if(isset($_GET['typeId'])) {
        echo retrieveGamesByType($_GET['status'],$_GET['typeId'],$_GET['amount']);
    } else {
        echo retrieveGames($_GET['status'],$_GET['amount']);
    }
} else {
    echo json_encode(["status" => "failed"]);
}

function retrieveGames($status, $amount) {
    $events = EventsAPI::get($status,$amount);
    if($events != null) {
        echo $events->toJson();
    } else {
        echo json_encode(["status" => "failed"]);
    }
}

function retrieveGamesByType($status, $typeId, $amount) {
    $events = EventsAPI::getByType($amount, $typeId, $status);
    if($events != null) {
        echo $events->toJson();
    } else {
        echo json_encode(["status" => "failed"]);
    }
}




