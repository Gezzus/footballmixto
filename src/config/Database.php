<?php

class Database {

    private $host = "localhost";
    private $db_name = "futbolmixto";
    private $username = "root";
    private $password = "";
    private $conn;

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new Database();
        }
        return $instance;
    }

    private function __construct() {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getConn() {
        return $this->conn;
    }
}