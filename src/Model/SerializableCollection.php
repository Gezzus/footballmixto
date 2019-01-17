<?php

namespace App\Model;

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

    public function jsonSerialize() {
        $return = array();
        foreach ($this->collection as $element) {
            $return[] = $element->jsonSerialize();
        }
        return $return;
    }

    public function size() {
        return count($this->collection);
    }

    public function get($i) {
        return $this->collection[$i];
    }
}
