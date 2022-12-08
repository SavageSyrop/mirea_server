<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
include_once "../api/objects/order.php";
include_once "./graphics.php";

$faker = Faker\Factory::create();
$orders = array();
$statuses = array("not started", "in progress", "finished", "denied");

for ($i = 0; $i < 50; $i++) {
    $order = new Order(NULL);
    $order->info = $faker->text();
    $order->status = $statuses[array_rand($statuses, 1)];
    $order->duration = rand(30, 180);
    $order->cost = rand(1, 10000);
    $order->master_id = rand(1, 2);
    $order->registration_time = date_timestamp_get($faker->dateTime());
    array_push($orders, $order);
}
drawByDuration($orders);
drawByCost($orders);
drawByTime($orders);
?>
<html lang="en">
  <head>
	<link rel="stylesheet" href="<?php echo $_SESSION['color_theme'] . ".css"?>" type="text/css" />
	<title>Practice 6</title>
  </head>
  <body>
  <img src="./img/watermarked_duration_graph.png">
  <img src="./img/watermarked_cost_graph.png">
  <img src="./img/watermarked_time_graph.png">
  </body>
</html>
