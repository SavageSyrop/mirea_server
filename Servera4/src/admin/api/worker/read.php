<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "../../../objects/worker.php";

$db = $mysqli;

$worker = new Worker($db);

$data = json_decode(file_get_contents("php://input"));

$stmt;

if ($data->id==NULL) {
    $stmt = $worker->readAll();
} else {
    $worker->id = $data->id;
    $stmt = $worker->read();
}



$stmt->bind_result($id, $name, $position);
$found = FALSE;

$worker_arr = array();
$worker_arr["workers"] = array();
while($stmt->fetch()) {
    $found = TRUE;
    $worker_item = array(
        "id" => $id,
        "name" => $name,
        "position" => $position);
    array_push($worker_arr["workers"], $worker_item);
}
$stmt->close();
if ($found === TRUE) {
    http_response_code(200);
    echo json_encode($worker_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Workers are not found"), JSON_UNESCAPED_UNICODE);
}
?>