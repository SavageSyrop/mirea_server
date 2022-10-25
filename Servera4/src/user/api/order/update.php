<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "../../../objects/order.php";

$db = $mysqli;
$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

$order->id = $data->id;
$order->client_id = $data->client_id;
$order->worker_id = $data->worker_id;
$order->description = $data->description;
$order->price = $data->price;
$order->creation_time = $data->creation_time;
$order->ready_time = $data->ready_time;
$order->closed_time = $data->closed_time;


if ($order->exists() && $order->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "The order is updated"), JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(503);
    echo json_encode(array("message" => "The order can not be updated"), JSON_UNESCAPED_UNICODE);
}
?>