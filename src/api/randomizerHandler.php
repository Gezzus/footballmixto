<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/RandomizerAPI.php";


if (isset($_POST['gameId'])) {
		error_log("1\n", 3, "/var/tmp/lgms.log");
        RandomizerAPI::randomize($_POST['gameId']);
        echo true;
} else {
    echo json_encode(["status" => "empty"]);
}

?>
