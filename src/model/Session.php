<?php

class Session {

    private $id; 
        
    public function __construct($id) {
        $this->id = $id;
        $this->start();
    }
    
    public function start() {
        session_start();
        $_SESSION['id'] = $this->id;
    }
    
    public static function stop() {
        session_destroy();
    }
    
    public static function validate(){
        if(isset($_SESSION['id'])){
            return new Session($_SESSION['id']);
        } else {
            return null;
        }
    }
    
    public static function create($id) {
        $session = new Session($id);            
        if(isset($_SESSION['id'])){
            return $session;
        } else {
            return null;
        }
    }

    public function toJson() {
        $result = [
            $id => $this->id
        ];
        return $result;
    }

    public function getId() {
        return $this->Id;
    }

    /*public function setId($id) {
        return $this->Id;
    }*/


}

?>