<?php
$dsn = "mysql:host=localhost;dbname=task_db2";
$username = "root";
$pw = "";

try {
    $conn = new PDO($dsn, $username, $pw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die ("Connection failed! " . $e->getMessage());
}