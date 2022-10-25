<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "./objects/order.php";

$db = $mysqli;
$order = new Order($db);

$stmt;

$data = json_decode(file_get_contents("php://input"));

if ($data->id==NULL) {
    $stmt = $order->readAll();
} else {
    $order->id = $data->id;
    $stmt = $order->read();
}

$stmt->bind_result($id, $client_id, $worker_id, $description, $price, $creation_time, $ready_time, $closed_time);

$found = FALSE;
$orders_arr = array();
$orders_arr["orders"] = array();
while($stmt->fetch()) {
    $found = TRUE;
    $order_item = array(
        "id" => $id,
        "client_id" => $client_id,
        "worker_id" => $worker_id,
        "description" => $description,
        "price" => $price,
        "creation_time" => $creation_time,
        "ready_time" => $ready_time,
        "closed_time" => $closed_time);
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
?>