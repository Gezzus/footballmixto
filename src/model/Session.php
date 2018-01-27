<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";

class Session implements Seriarizable {

    private $id; 
        
    public function __construct() {
        
    }

    public function build($id) {
        $this->id = $id;
    }
    
    public static function start() {
        return session_start();
    }
    
    
    public static function stop() {
        return session_destroy();
    }
    
    public function validate(){
        if(isset($_SESSION['id'])){
         $this->build($_SESSION['id']);
          return $this;
        } else {
            return null;
        }
    }
    
    public static function create($id) {
        $session = new Session();
        $session->start();
        $_SESSION['id'] = $id;
        $session->build($_SESSION['id']);
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
        return $this->id;
    }


}
    /*public function setId($id) {
        return $this->Id;
    }*/


?>