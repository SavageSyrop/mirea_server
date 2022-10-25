<?php
class Order {
    private $conn;
    private $table_name = "orders";

    public $id;
    public $client_id;
    public $worker_id;
    public $description;
    public $price;
    public $creation_time;
    public $ready_time;
    public $closed_time;


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
        $query = "INSERT INTO " . $this->table_name . "(client_id, worker_id, description, price, creation_time, ready_time, closed_time) VALUES 
        ({$this->client_id},{$this->worker_id}, \"{$this->description}\", {$this->price}, STR_TO_DATE(\"{$this->creation_time}\", \"%d.%m.%Y %H:%i\"), 
        STR_TO_DATE(\"{$this->ready_time}\", \"%d.%m.%Y %H:%i\"), STR_TO_DATE(\"{$this->closed_time}\", \"%d.%m.%Y %H:%i\"))";
        
        $stmt = $this->conn->prepare($query);

        $this->client_id = htmlspecialchars(strip_tags($this->client_id));
        $this->worker_id = htmlspecialchars(strip_tags($this->worker_id));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->creation_time = htmlspecialchars(strip_tags($this->creation_time));
        $this->ready_time = htmlspecialchars(strip_tags($this->ready_time));
        $this->closed_time = htmlspecialchars(strip_tags($this->closed_time));

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . "
        SET
            client_id={$this->client_id},
            worker_id={$this->worker_id},
            description=\"{$this->description}\",
            price={$this->price},
            creation_time=STR_TO_DATE(\"{$this->creation_time}\", \"%d.%m.%Y %H:%i\"),
            ready_time=STR_TO_DATE(\"{$this->ready_time}\", \"%d.%m.%Y %H:%i\"),
            closed_time=STR_TO_DATE(\"{$this->closed_time}\", \"%d.%m.%Y %H:%i\")    
        WHERE
            id = {$this->id};";

        $stmt = $this->conn->prepare($query);

        $this->client_id = htmlspecialchars(strip_tags($this->client_id));
        $this->worker_id = htmlspecialchars(strip_tags($this->worker_id));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->creation_time = htmlspecialchars(strip_tags($this->creation_time));
        $this->ready_time = htmlspecialchars(strip_tags($this->ready_time));
        $this->closed_time = htmlspecialchars(strip_tags($this->closed_time));

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