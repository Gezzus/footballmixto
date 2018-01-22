<?php

class Session implements Seriarizable {

    private $id; 
        
    public function __construct($id) {
        $this->id = $id;
        $this->start();
    }

    public static function start() {
        if(session_start()){
        $_SESSION['id'] = $this->id;
        return ["status" => "success"];
        } else { 
            return null;
        }

    }
    
    public static function stop() {
        session_destroy();
    }
    
    public static function validate(){
        if(isset($_SESSION['id'])){
            return $_SESSION['id'];
        } else {
            return null;
        }
    }
    
    public static function create($id) {
        $session = new Session($id)
            return $session;
        }

    public function toArray() {
        $result = [
            $id => $this->id
        ];
        return $result;
    }

    public function toJson() {
        
        return json_encode($this->toArray());
    }

    public function getId() {
        return $this->Id;
    }

    public function getSession() {
         if(isset($_SESSION['id'])){
            return new Session($id);
        } else {
            return null;
        }
    }


    /*public function setId($id) {
        return $this->Id;
    }*/


?>