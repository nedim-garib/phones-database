<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    require("connect.php");

    $query = "delete from phones where phone_id = {$id}";
    $conn->exec($query);
    header("Location: ../remove.php");
}
?>