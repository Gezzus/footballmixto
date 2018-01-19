<?php

class Session {

    private $id; 
        
    public function __construct() {
        $this->start();
    }
    
    public static function start() {
        session_start();
    }
    
    public static function stop() {
        session_destroy();
    }
    
    public static function validate(){
        if(isset($_SESSION['id'])){
            echo "SUCCESS: ".$_SESSION['id'];
            return $_SESSION['id'];
        }else {
            return null;
        }
    }
    
    public function create($id) {
        if(session_start()){
            $this->id = $id;
            return $id;             
        } else {
            return null;
        }
    }


}

?>