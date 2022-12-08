<?php
session_start();

if (!isset($_SESSION['color_theme'])) {
    $_SESSION['color_theme'] = 'light_color_theme';
}
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'Anonymous';
}
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = "eng";
}
?>