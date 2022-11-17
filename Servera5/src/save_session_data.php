<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_session'])) {
	if (isset($_POST['color_theme'])) {
        $redis->set('color_theme', $_POST['color_theme']);
	}

	if (isset($_POST['language'])) {
        $redis->set('language', $_POST['language']);
	}

	if (isset($_POST['username'])) {
		$redis->set('username', $_POST['username']);
	}
	loadData($redis);
}
?>