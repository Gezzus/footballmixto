<?php

include_once "../config/Database.php";

class PersistentEntity {

    public static function sanitize($value) {
        return Database::getInstance()->getConn()->quote($value);
    }

    public static function lastInsertId() {
        return Database::getInstance()->getConn()->lastInsertId();
    }

    public static function query($query) {
        return Database::getInstance()->getConn()->query($query);
    }

    public static function queryWithParameters($query, $params) {
        $statement = Database::getInstance()->getConn()->prepare($query);
        for ($i = 0; $i < count($params); $i++) {
            $statement->bindParam($i + 1, self::sanitize($params[$i]));
        }
        $statement->execute();
        return $statement;
    }
}