<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/Session.php";
    
    $session = new Session();
    if($session->validate() != null) {
        $response = ["status" => "success"];
        echo json_encode($response);
    } else {
        $response = ["status" => "failed"];
        echo json_encode($response);
    }
?>
