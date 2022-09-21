<?php
?>

<html lang="en">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
	<body>
	<h1>Information and administrative web-page about the server</h1>
    <h2>List of files:</h2>
    <p><?php echo str_replace("\n", "<br>", shell_exec('ls')); ?></p>
    <h2>List of processes:</h2>
    <p><?php echo str_replace("\n", "<br>", shell_exec('ps')); ?></p>
    <h2>Your username:</h2>
    <p><?php echo str_replace("\n", "<br>", shell_exec('whoami')); ?></p>
    <h2>Your id:</h2>
    <p><?php echo str_replace("\n", "<br>", shell_exec('id')); ?></p>
</body>
</html>
