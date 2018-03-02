<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";

class Admin extends PersistentEntity {
    public static function runQuery($context) {
        $Query = self::query($context);
        return $Query->fetchAll();
    }

    public static function getLastError() {
        return self::queryErrorInfo();
    }

}