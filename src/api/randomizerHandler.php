<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/RandomizerAPI.php";


if (isset($_POST['gameId'])) {
        echo json_encode(["result" => RandomizerAPI::randomize($_POST['gameId'])]);
} else {
    echo json_encode(["status" => "empty"]);
}

?>
