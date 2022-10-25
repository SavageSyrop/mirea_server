<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "../../../objects/order.php";

$db = $mysqli;
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->client_id) &&
    !empty($data->worker_id) &&
    !empty($data->description) &&
    !empty($data->price) &&
    !empty($data->creation_time) &&
    !empty($data->ready_time) &&
    !empty($data->closed_time)) {
    $order->client_id = $data->client_id;
    $order->worker_id = $data->worker_id;
    $order->description = $data->description;
    $order->price = $data->price;
    $order->creation_time = $data->creation_time;
    $order->ready_time = $data->ready_time;
    $order->closed_time = $data->closed_time;

    if ($order->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "The order is created"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Can not create an order"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Can not create this order. Some data is not filled."), JSON_UNESCAPED_UNICODE);
}
?>