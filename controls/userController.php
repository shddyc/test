<?php

class userController{

    public function __construct(){
        // Aquí puedes inicializar cualquier recurso necesario, como la conexión a la base de datos
    }

    public function index($userId = null){
        if ($userId) {
            // Lógica para mostrar un usero específico
            Lib::response("Mostrando el usuario con ID: " . $userId);
        } else {
            // Lógica para mostrar todos los usuarios
            Lib::response("Mostrando todos los usuarios");
        }
    }

    public function update(){
        Lib::response("Update user");
    }

    public function create(){
        Lib::response("Create user");
    }

} 