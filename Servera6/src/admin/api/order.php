<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "./objects/order.php";

$db = $mysqli;
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        $order->read($data);
        break;
    case 'PUT':
        $order->create($data);
        break;
    case 'POST':
        $order->update($data);
        break;
    case 'DELETE':
        $order->delete($data);
        break;
}
?>