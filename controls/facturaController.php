<?php

class facturaController{

    public function __construct(){
        // Aquí puedes inicializar cualquier recurso necesario, como la conexión a la base de datos
    }

    public function index($facturaId = null){
        if ($facturaId) {
            // Lógica para mostrar un factura específico
            Lib::response("Mostrando el Factura con ID: " . $facturaId);
        } else {
            // Lógica para mostrar todos los Facturas
            Lib::response("Mostrando todos los Facturas");
        }
    }

    public function detalles($facturaId, $action = null){
         if ($action) {
            // Lógica para mostrar un factura específico
            Lib::response("Mostrando el detalle del Factura con ID: " . $facturaId . " y acción: " . $action);
        } else {
            // Lógica para mostrar todos los Facturas
            Lib::response("Mostrando el detalle del Factura con ID: " . $facturaId);
        }
    }

    public function update(){
        Lib::response("Update factura");
    }

    public function create(){
        Lib::response("Create factura");
    }

} 