<?php
include_once "services/productServices.php";
class productController{

    public function __construct(){
        // Aquí puedes inicializar cualquier recurso necesario, como la conexión a la base de datos
    }

    public function index($productId = null){
        if ($productId) {
           // Lógica para mostrar todos los productos
            $product = productServices::getProduct($productId);
            Lib::response($product);
        } else {
            // Lógica para mostrar todos los productos
            $products = productServices::getProducts();
            Lib::response($products);
        }
    }

    public function add(){
        $product = productServices::createProduct();
        Lib::response($product);
    }

    public function remove($productId){
        productServices::removeProduct($productId);
        Lib::response("Product removed successfully");
    }

    public function update(){
        productServices::updateProduct();
        Lib::response("Update product");
    }

    public function create(){
        Lib::response("Create product");
    }

} 