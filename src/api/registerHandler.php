<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/UserAPI.php";

if (isset( $_POST['userName'] ) && isset( $_POST['password']) &&
    isset( $_POST['nickName'] ) && isset( $_POST['genderId']) &&
    isset( $_POST['skillId'] ) /*&& isset( $_POST['email']*/) {
        $user = UserAPI::register($_POST['userName'], $_POST['password'], $_POST['nickName'], $_POST['genderId'], $_POST['skillId']);
        echo $user;
} else {
    echo json_encode(["status" => "empty"]);
}

?>
