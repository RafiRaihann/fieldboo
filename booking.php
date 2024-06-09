<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: logres/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <H1>HALAMAN BOOKING OM</H1>
</body>

</html>