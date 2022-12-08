<?php
class Order {
    private $conn;
    private $table_name = "orders";

    public $id;
    public $info;
    public $status;
    public $duration;
    public $cost;
    public $master_id;
    public $registration_time;

    public function __construct($db) {
        $this->conn = $db;
    }

    function exists() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->fetch()) {
            return true;
        }
        return false;;
    }

    function read($data) {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $info, $status, $duration, $cost, $master_id, $registration_time);
        $found = FALSE;
        $orders_arr = array();
        $orders_arr["orders"] = array();
        while($stmt->fetch()) {
            $found = TRUE;
            $order_item = array(
                "id" => $id,
                "info" => $info,
                "status" => $status,
                "duration" => $duration,
                "cost" => $cost,
                "master_id" => $master_id,
                "registration_time" => $registration_time);
            array_push($orders_arr["orders"], $order_item);
        }
        $stmt->close();
        if ($found === TRUE) {
            http_response_code(200);
            echo json_encode($orders_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Orders are not found"), JSON_UNESCAPED_UNICODE);
        }
    }

    function create($data) {
        if (
            empty($data->info) ||
            empty($data->status) ||
            empty($data->duration) ||
            empty($data->cost) ||
            empty($data->master_id) ||
            empty($data->registration_time)) {
                http_response_code(400);
                echo json_encode(array("message" => "Can not create this order. Some data is not filled."), JSON_UNESCAPED_UNICODE);
                return;
        }

        $this->info = $data->info;
        $this->status = $data->status;
        $this->duration = $data->duration;
        $this->cost = $data->cost;
        $this->master_id = $data->master_id;
        $this->registration_time = $data->registration_time;

        $query = "INSERT INTO " . $this->table_name . "(info, status, duration, cost, master_id, registration_time) VALUES 
        (\"{$this->info}\", \"{$this->status}\", {$this->duration}, {$this->cost}, {$this->master_id}, STR_TO_DATE(\"{$this->registration_time}\", \"%d.%m.%Y %H:%i\"))";
        
        $stmt = $this->conn->prepare($query);

        $this->info = htmlspecialchars(strip_tags($this->info));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->duration = htmlspecialchars(strip_tags($this->duration));
        $this->cost = htmlspecialchars(strip_tags($this->cost));
        $this->master_id = htmlspecialchars(strip_tags($this->master_id));
        $this->registration_time = htmlspecialchars(strip_tags($this->registration_time));

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(array("message" => "The order is created"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Can not create an order"), JSON_UNESCAPED_UNICODE);
        }
    }

    function update($data) {
        $this->id = $data->id;
        $this->info = $data->info;
        $this->status = $data->status;
        $this->duration = $data->duration;
        $this->cost = $data->cost;
        $this->master_id = $data->master_id;
        $this->registration_time = $data->registration_time;
        if (! $this->exists()) {
            http_response_code(400);
            echo json_encode(array("message" => "The order with id " . $this->id . " is not found"), JSON_UNESCAPED_UNICODE);
            return;
        }
        $query = "UPDATE " . $this->table_name . "
        SET
            info=\"{$this->info}\",
            status=\"{$this->status}\",
            duration={$this->duration},
            cost={$this->cost},
            master_id={$this->master_id},
            registration_time=STR_TO_DATE(\"{$this->registration_time}\", \"%d.%m.%Y %H:%i\")        
        WHERE
            id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        
        $this->info = htmlspecialchars(strip_tags($this->info));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->duration = htmlspecialchars(strip_tags($this->duration));
        $this->cost = htmlspecialchars(strip_tags($this->cost));
        $this->master_id = htmlspecialchars(strip_tags($this->master_id));
        $this->registration_time = htmlspecialchars(strip_tags($this->registration_time));
    
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array("message" => "The order is updated"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "The order can not be updated"), JSON_UNESCAPED_UNICODE);
        }
    }

    function delete($data) {
        $this->id = $data->id;
        if (! $this->exists()) {
            http_response_code(400);
            echo json_encode(array("message" => "The order with id " . $this->id . " is not found"), JSON_UNESCAPED_UNICODE);
            return;
        }
        $query = "DELETE FROM " . $this->table_name . " WHERE id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array("message" => "The order is deleted"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "The order can not be deleted"), JSON_UNESCAPED_UNICODE);
        }
    }
}
?>