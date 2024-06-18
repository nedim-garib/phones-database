<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="script.js"></script>
</head>
<body>
    <div id="wrap">
        <div id="main">
            <h1>Phone Database</h1>
            <div id="inner_div">
                <button id="openForm" class="custom">Add new phone</button>
                <a href="remove.php" class="custom">Show all phones</a>
            </div>
            <div id="formContainer" style="display: none;">
                <form id="insertForm" name="insert" action="#" method="post">
                    <select id="i_select" name="manufacturer_id" defaultValue="" required>
                        <option hidden value="">-- Select a manufacturer --</option>
                        <?php require("include/items.php"); foreach ($res as $value) {
                        ?>
                        <option value = <?php echo $value["manufacturer_id"];?>><?php echo $value["name"];?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="i_model">Model: </label>
                    <input type="text" id="i_model" name="model" value="<?php if(isset($_POST["model"])) echo htmlspecialchars($_POST["model"]); ?>"/>
                    <label for="i_price">Cijena: </label>
                    <input type="text" id="i_price" name="price" value="<?php if(isset($_POST["price"])) echo htmlspecialchars($_POST["price"]); ?>"/>
                    <label for="i_year">Godina proizvodnje:</label>
                    <input type="text" id="i_year" name="year" value="<?php if(isset($_POST["year"])) echo htmlspecialchars($_POST["year"]); ?>"/>
                    <input type="submit" id="send" name="submit" value="Save"/>
                </form>
            </div>
            <div id="message">
            <?php

            if (isset($_POST["submit"])) {

            if (isset($_POST["model"]) && isset($_POST["price"]) && isset($_POST["year"])) {

                $model = trim($_POST["model"]);
                $price = trim($_POST["price"]);
                $year = trim($_POST["year"]);
                $man_id = $_POST["manufacturer_id"];

                if (preg_match("/^[a-zA-Z0-9\s]+$/", $model) && preg_match("/^\d+(\.\d+)?$/", $price) && $year > 2010 && $year <= 2024) {

                    require("include/connect.php");
    
                    $stmt = $conn->prepare("insert into phones (manufacturer_id, model, price, production_year) values (:manufacturer_id, :model, :price, :year)");
                    $stmt->bindParam(":manufacturer_id", $man_id);
                    $stmt->bindParam(":model", $model);
                    $stmt->bindParam(":price", $price);
                    $stmt->bindParam(":year", $year);
                    $stmt->execute();
    
                    if ($stmt) {
                        echo "New mobile phone added succesfully!";
                    }
                    else {
                        echo "Query error!";
                    }
                }
                elseif (empty($model) || empty($price) || empty($year)) {
                    echo "All fields must contain a value!";
                }
                else {
                    echo "Invalid inputs!";
                }
            }
            }
            ?>
            </div>
        </div>
    </div>
</body>
</html>