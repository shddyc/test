<?php
//Incluir archivos necesarios para iniciar la aplicación
include_once "config.php";
include_once "lib/Lib.php";
include_once "lib/Router.php";
//ejecutar endpoint
Router::start();
