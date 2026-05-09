<?php

class Router
{
    public static function start()
    {
        $route = explode("/", $_GET['url']);
        $control = $route[0] ?? '';
        $method = $route[1] ?? '';
        $var1 = $route[2] ?? '';
        $var2 = $route[3] ?? '';

        if (empty($method)) {
            $method = 'index';
        }
        if (is_numeric($method)) {
            $var1 = $method;
            $method = 'index';
        }

        $control = $control . "Controller";

        if (file_exists("controls/{$control}.php")) {
            include_once "controls/{$control}.php";
        } else {
            Lib::response_error("Error: Controlador no encontrado.");
            exit;
        }

        if (class_exists($control)) {
            if (method_exists($control, $method)) {
                // El controlador y el método existen, puedes continuar con la lógica de tu aplicación
                $controller = new $control();
                $controller->$method($var1, $var2);
            } else {
                // El método no existe, maneja el error adecuadamente
                Lib::response_error("Error: Método no encontrado.");
                exit;
            }
        } else {
            // El controlador o el método no existen, maneja el error adecuadamente
            Lib::response_error("Error: Controlador o método no encontrado.");
            exit;
        }
    }
}
