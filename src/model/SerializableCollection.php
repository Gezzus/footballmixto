<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";

class SerializableCollection implements Seriarizable {

    private $collection;

    function __construct() {
        $this->collection = array();
    }

    public function add($element) {
        array_push($this->collection, $element);
    }
    
    public function remove($element) {
        $position = array_search($element, $this->collection);
        unset($this->collection[$position]);
    }

    public function toJson() {
    }

    public function toArray() {
        $return = array();
        foreach ($this->collection as $element) {
            $return[] = $element->toArray();
        }
        return $return;
    }

    public function size() {
        count($this->collection);
    }

    public function get($i) {
        $this->collection[$i];
    }
}
