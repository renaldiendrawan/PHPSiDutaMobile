<?php

$connection = null;

try {

    $host = "localhost";
    $username = "tifz1761_root";
    $password = "tifnganjuk321";
    $dbname = "tifz1761_posyandu";

    // Connect
    $database = "mysql:host=$host;dbname=$dbname";

    // $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error ! " . $e->getMessage();
    die;
}
