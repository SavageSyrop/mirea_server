<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_session'])) {
// $data_redis = json_encode([
// "color_theme" => $_POST['color_theme'],
// "username" => $_POST['username'],
// "language" => $_POST['language'],
// ]);

// $redis->set($_SERVER['PHP_AUTH_USER'], $data_redis);

$_SESSION['color_theme'] = $_POST['color_theme'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['language'] = $_POST['language'];
}
?>