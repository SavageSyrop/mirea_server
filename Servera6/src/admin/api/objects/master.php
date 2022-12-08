<?php
class Master {
    private $conn;
    private $table_name = "masters";

    public $id;
    public $name;
    public $end_of_work_time;

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
        $stmt->bind_result($id, $name, $end_of_work_time);
        $found = FALSE;

        $masters_arr = array();
        $masters_arr["masters"] = array();
        while($stmt->fetch()) {
            $found = TRUE;
            $master_item = array(
                "id" => $id,
                "name" => $name,
                "end_of_work_time" => $end_of_work_time);
            array_push($masters_arr["masters"], $master_item);
        }
        $stmt->close();
        if ($found === TRUE) {
            http_response_code(200);
            echo json_encode($masters_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Masters are not found"), JSON_UNESCAPED_UNICODE);
        }
    }

    function create($data) {
        $this->name = $data->name;
        $this->end_of_work_time = $data->end_of_work_time;
        
        if (empty($data->name) || empty($data->end_of_work_time)) {
            http_response_code(400);
            echo json_encode(array("message" => "Can not create this master. Some data is not filled."), JSON_UNESCAPED_UNICODE);
        }

        $query = "INSERT INTO " . $this->table_name . "(name, end_of_work_time) VALUES 
        (\"{$this->name}\", STR_TO_DATE(\"{$this->end_of_work_time}\", \"%d.%m.%Y %H:%i\"))";
        
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->end_of_work_time = htmlspecialchars(strip_tags($this->end_of_work_time));

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(array("message" => "The master is created"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Can not create a master"), JSON_UNESCAPED_UNICODE);
        }
    }

    function update($data) {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->end_of_work_time = $data->end_of_work_time;
        if (! $this->exists()) {
            http_response_code(400);
            echo json_encode(array("message" => "The master with id " . $this->id . " is not found"), JSON_UNESCAPED_UNICODE);
            return;
        }
        $query = "UPDATE " . $this->table_name . "
        SET
            name=\"{$this->name}\",
            end_of_work_time=STR_TO_DATE(\"{$this->end_of_work_time}\", \"%d.%m.%Y %H:%i\")        
        WHERE
            id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->end_of_work_time = htmlspecialchars(strip_tags($this->end_of_work_time));
    
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array("message" => "The master is updated"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "The master can not be updated"), JSON_UNESCAPED_UNICODE);
        }
    }

    function delete($data) {
        $this->id = $data->id;
        if (! $this->exists()) {
            http_response_code(400);
            echo json_encode(array("message" => "The master with id " . $this->id . " is not found"), JSON_UNESCAPED_UNICODE);
            return;
        }
        $query = "DELETE FROM " . $this->table_name . " WHERE id = {$this->id}";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array("message" => "The master is deleted"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "The master can not be deleted"), JSON_UNESCAPED_UNICODE);
        }
    }
}
?>