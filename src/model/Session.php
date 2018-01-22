<?php

class Session {

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
            return ["status" => "failed"];
        }
    }
    
    public static function stop() {
        session_destroy();
    }
    
    public static function validate(){
        if(isset($_SESSION['id'])){
            return $_SESSION['id'];
        }else {
            return null;
        }
    }
    
    public static function create($id) {
        $session = new Session($id);
        if($session->validate()){
            return $session;
        } else {
            return null;
        }
    }
}

?>