<?php
include_once "Entity.php";

class Product extends Entity {
    public $title;
    public $precio;
    public $cost;
    public $cantidad;

    public function getTable()
    {
        return "product";
    }

    public function __construct($id = null) {
        if($id){
            $this->getById($id);
        }
    }
}