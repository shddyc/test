<?php

class Lib{

    private static function response_final($data, $status = 200, $message = "Success"){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode(["status" => $message,"data" => $data]);
        exit;
    }

    public static function response($data, $status = 200){
        self::response_final($data, $status);
    }

    public static function response_error($message, $status = 500){
        self::response_final($message, $status, "Error");
    }

    public static function response_nofound($message, $status = 404){
        self::response_final($message, $status, "No Found");
    }

}