<?php

include_once "../config/Database.php";

class PersistentEntity {

    public function sanitize($value) {
        return Database::getInstance()->getConn()->quote($value);
    }

    public function lastInsertId() {
        return Database::getInstance()->getConn()->lastInsertId();
    }

    public function query($query) {
        return Database::getInstance()->getConn()->query($query);
    }

    public function queryWithParameters($query, $params) {
        $statement = Database::getInstance()->getConn()->prepare($query);
        for ($i = 0; $i < count($params); $i++) {
            $statement->bindParam($i + 1, $this->sanitize($params[$i]));
        }
        $statement->execute();
        return $statement;
    }
}