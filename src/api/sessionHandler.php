<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/User.php";

    $session = Session::validate();

    if($session != null) {
        if($_GET["action"] == "allow") {
            $response = ["status" => "success"];
            echo json_encode($response);
        }
        else if($_GET["action"] == "prevent") {
            $user = User::getUserById($session->getId());
            $response = ["status" => "failure","username" => $user->getUserName()];
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
