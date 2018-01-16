<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "src/config/Database.php";

class PersistentEntity {

    protected static function sanitize($value) {
        return Database::getInstance()->getConn()->quote($value);
    }

    protected static function lastInsertId() {
        return Database::getInstance()->getConn()->lastInsertId();
    }

    protected static function query($query) {
        return Database::getInstance()->getConn()->query($query);
    }

    protected static function queryWithParameters($query, $params) {
        $statement = Database::getInstance()->getConn()->prepare($query);
        for ($i = 0; $i < count($params); $i++) {
            $statement->bindParam($i + 1, $params[$i]);
        }
        $statement->execute();
        return $statement;
    }
}
