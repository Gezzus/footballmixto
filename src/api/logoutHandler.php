<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";    
$session = new Session;
$session->start();    
if($session->stop()){
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);
}
