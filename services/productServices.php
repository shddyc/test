<?php

include_once "models/Product.php";

class productServices {

    public static function getProducts() {
        $product = new Product();
        return $product->getAll();
    }

    public static function getProduct($id) {
        $product = new Product($id);
        return $product;
    }

    public static function createProduct() {
        $product = new Product();
        $product->title = "Producto de prueba";
        $product->precio = 100;
        $product->cost = 80;
        $product->save();
        return $product;
    }

    public static function updateProduct() {
        $product = new Product(4);
        $product->title = "Producto de prueba actualizado";
        $product->precio = 120;
        $product->cost = 90;
        $product->save();
        return $product;
    }

    public static function removeProduct($id) {
        $product = new Product($id);
        $product->remove();
    }

    public static function deleteProduct() {

    }

}