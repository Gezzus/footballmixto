<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";
  
    $session = new Session();
    if($session->validate() != null) {
        if($_GET["action"] == "allow") {
            $response = ["status" => "success"];
            echo json_encode($response);
        }
        else if($_GET["action"] == "prevent") {
            $response = ["status" => "failure"];
            echo json_encode($response);
        } 
    } else {
        if($_GET["action"] == "allow") {
            $response = ["status" => "failure"];
            echo json_encode($response);
        } else if ($_GET["action"] == "prevent"){
            $response = ["status" => "success"];
            echo json_encode($response);
        }
    }
?>
