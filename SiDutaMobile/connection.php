<?php

$connection = null;

try {
    // Config 
    $host = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "test_posyandu";

    // Connect
    $database = "mysql:host=$host;dbname=$dbname";
    // $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error ! " . $e->getMessage();
    die;
}
