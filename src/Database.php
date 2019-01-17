<?php

namespace App;

use \PDO;

class Database {
    private $host = "localhost";
    private $db_name = "futbolmixto";
    private $username = "dev";
    private $password = "";
    private $conn;

    static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new Database();
        }
        return $instance;
    }

    private function __construct() {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->exec('SET NAMES UTF8');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    function getConn() {
        return $this->conn;
    }
}
