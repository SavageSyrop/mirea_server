<?php
class Worker {
    private $conn;
    private $table_name = "workers";

    public $id;
    public $name;
    public $position;


    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . "(name, position) VALUES 
        (\"{$this->name}\", \"{$this->position}\")";
       ;
        
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->position = htmlspecialchars(strip_tags($this->position));


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . "
        SET
            name=\"{$this->name}\",
            position=\"{$this->position}\"
        WHERE
            id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->position = htmlspecialchars(strip_tags($this->position));


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function exists() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->fetch()) {
            return true;
        }
        return false;
    }
}
?>