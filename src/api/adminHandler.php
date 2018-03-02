<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/User.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Admin.php";

if(isset($_POST['context'])) {
    $thisUserSession = new Session();
    $thisUserSession->start();
    $thisUserSession->validate();
    $thisUser = User::getById($thisUserSession->getId());
    if($thisUser == null) {
        echo json_encode(["status" => "failed", "message" => "undefined user"]);
    } else {
        if ($thisUser->getUserName() == 'Alessandro') {
            try {
                echo json_encode(["status" => "success", "message" => Admin::runQuery($_POST['context'])]);
            } catch (Exception $exception) {
                try {
                    var_dump(Admin::runQuery($_POST['context']));
                } catch (Exception $exception) {
                    echo json_encode(["status" => "failed", "message" => Admin::getLastError()]);
                }
            }
        } else {
            echo json_encode(["status" => "failed", "message" => "You don't have permission to do this."]);
        }
    }
} else {
    echo json_encode(["status" => "empty"]);
}
