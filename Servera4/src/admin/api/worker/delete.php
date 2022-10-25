<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "../../../objects/worker.php";

$db = $mysqli;
$worker = new Worker($db);

$data = json_decode(file_get_contents("php://input"));

$worker->id = $data->id;

if ($worker->exists() && $worker->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "The worker is deleted"), JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(503);
    echo json_encode(array("message" => "The worker can not be deleted"), JSON_UNESCAPED_UNICODE);
}
?>