<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Events.php";

class EventsAPI {

    public static function getByType($status, $typeId, $amount) {
        $events = Events::getByType($status,$typeId,$amount);
        if($events != null) {
            return $events;
        } else {
            return null;
        }
    }

    public static function get($status,$amount) {
        $events = Events::get($status, $amount);
        if ($events != null) {
            return $events;
        } else {
            return null;
        }
    }

}

