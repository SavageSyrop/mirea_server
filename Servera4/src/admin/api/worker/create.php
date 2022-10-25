<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "../../../objects/worker.php";

$db = $mysqli;
$worker = new Worker($db);
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->position)
) {
    $worker->name = $data->name;
    $worker->position = $data->position;

    if ($worker->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "The worker is created"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Can not create a worker"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Can not create this worker. Some data is not filled."), JSON_UNESCAPED_UNICODE);
}
?>