<?php

abstract class Entity {
    public $id;
    private $DB = null;
    abstract public function getTable();

    public function __construct() {

    }

    private function connectDB() {
        if($this->DB === null) {
            $this->DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if ($this->DB->connect_error) {
                Lib::response_error("Connection failed: " . $this->DB->connect_error);
            }
        }
    }

    public function getById($id) {
        $this->getBy("id = $id");
    }

    public function getBy($where) {
        if(!empty($where)) {           
            $table = $this->getTable();
            $this->connectDB();
            $result = $this->DB->query("SELECT * FROM $table WHERE $where");
            if ($result->num_rows > 0) {
                $obj = $result->fetch_object();
                foreach (get_object_vars($obj) as $key => $value) {
                    $this->$key = $value;
                }
            } else {
                Lib::response_error("Record not found");
            }
        }else{
            Lib::response_error("Record not found");
        }
    }

    public function getAll() {
        return $this->getAllBy(false);
    }

    public function getAllBy($where){
        $table = $this->getTable();
        $this->connectDB();
        $where = $where ? "WHERE $where" : "";
        $result = $this->DB->query("SELECT * FROM $table $where"); 
        return $this->fetch($result);
    }

    private function fetch($result){
         while ($obj = $result->fetch_object(static::class)) {
            $objects[] = $obj;
        }
        return $objects ?? [];
    }

    public function save() {       
        $table = $this->getTable();
        $data = get_object_vars($this);
        if (empty($this->id)) {
            //insert
            $this->insert($table, $data);
        } else {
            //update
            $this->update($table, $data, "id = {$this->id}");
        }
    }

    public function remove() {
        if($this->id > 0){
            $table = $this->getTable();
            $this->connectDB();
            $sql = "DELETE FROM $table WHERE id = {$this->id}";
            if ($this->DB->query($sql) === TRUE) {
                return true;
            } else {
                Lib::response_error("Error: " . $sql . "<br>" . $this->DB->error);
            }
        }else Lib::response_nofound("Record not found");    
    }

    private function insert($table, $data) {
        $this->connectDB();
        $ref = new ReflectionClass(static::class);

        // Solo propiedades públicas
        $props = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
        
        foreach ($props as $prop) {
            $key = $prop->getName();
            if($key == "id") continue; // Omitir el campo id
            $obj[$key] = $data[$key] ?? null;
        }

        $columns = implode(", ", array_keys($obj));
        $values = "'".implode("', '", array_values($obj))."'";
        
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        if ($this->DB->query($sql) === TRUE) {
            $this->id = $this->DB->insert_id;
        } else {
            Lib::response_error("Error: " . $sql . "<br>" . $this->DB->error);
        }
    }   

    private function update($table, $data, $where){
         $this->connectDB();
        $ref = new ReflectionClass(static::class);

        // Solo propiedades públicas
        $props = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
        $obj = array();
        foreach ($props as $prop) {
            $key = $prop->getName();
            if($key == "id") continue; // Omitir el campo id
            $obj[$key] = "$key = '" . $data[$key] . "'";
        }

        $columns_values = implode(", ", $obj);        
        $sql = "UPDATE $table SET $columns_values WHERE $where";
        if ($this->DB->query($sql) === TRUE) {
            $this->id = $this->DB->insert_id;
        } else {
            Lib::response_error("Error: " . $sql . "<br>" . $this->DB->error);
        }
    }

}
