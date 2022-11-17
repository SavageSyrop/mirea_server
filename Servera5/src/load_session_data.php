<?php

$redis = new Redis(); 
$redis->connect('cache', 6379);

function loadColorTheme($redis) {
    if ($redis->get('color_theme') !== null) {
        $_SESSION['color_theme'] = $redis->get('color_theme');
    } else {
        $_SESSION['color_theme'] = 'light_theme_style';
    }
}

function loadUsername($redis) {
    if ($redis->get('username') === null) {
        $_SESSION['username'] = "Anonymous";
    } else {
        $_SESSION['username'] = $redis->get('username');
    }
}

function loadLanguage($redis) {
    if ($redis->get('language') === null) {
        $_SESSION['language'] = "eng";
    } else {
        $_SESSION['language'] = $redis->get('language');
    }
}


function loadData($redis) {
    loadColorTheme($redis);
    loadUsername($redis);
    loadLanguage($redis);
}

// ini_set('session.save_handler', 'redis');
// ini_set('session.save_path', 'tcp://localhost:6379');
session_start();
loadData($redis);
?>