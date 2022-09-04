<?php

session_start();

?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Session Demo</title>
</head>
<body>

    <h1>PHP Session Demo</h1>

    <p>Current session ID: <?php echo session_id(); ?></p>

    <p><a href="destroy.php">Destroy</a></p>

</body>
</html>
