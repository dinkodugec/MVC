<!DOCTYPE html>
<html>
<head>
    <title>Output escaping</title>
    <meta charset="utf-8"> 
</head>
<body>
    <h1>Output escaping</h1>

<?php

    // Display the results of submitting the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "Hello, " . htmlspecialchars($_POST['name']);   
    }

?>

    <form method="post">
        <div>
            <label for="name">Your name</label>
            <input id="name" name="name" autofocus />
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

</body>
</html>
