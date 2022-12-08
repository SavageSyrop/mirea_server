<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
include_once "./objects/master.php";

$db = $mysqli;
$master = new Master($db);
$data = json_decode(file_get_contents("php://input"));
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        $master->read($data);
        break;
    case 'PUT':
        $master->create($data);
        break;
    case 'POST':
        $master->update($data);
        break;
    case 'DELETE':
        $master->delete($data);
        break;
}
?>