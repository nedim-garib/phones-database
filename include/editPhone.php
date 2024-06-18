<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/style3.css">
</head>
<body>
    <div id="main">
    <div id="formContainer">
        <form id="insertForm" name="insert" action="#" method="post">
            <?php
            require ("connect.php");
            $param = $_GET["id"];
            $query = "select * from phones join manufacturers on phones.manufacturer_id = manufacturers.manufacturer_id where phone_id = {$param}";
            $query2 = "select * from manufacturers";
            $array = $conn->query($query);
            foreach ($array as $v) {
                $default = $v["manufacturer_id"];
            }
            $res = $conn->query($query2);
            ?>
            <select id="i_select" name="manufacturer_id" required>
            <?php
            foreach ($res as $value) {
                echo $value["name"];
            ?>
                <option value = "<?php echo $value["manufacturer_id"];?>"<?php echo ($value["manufacturer_id"] == $default) ? 'selected' : '';?>><?php echo $value["name"];?></option>
            <?php
            }
            ?>
            </select>
            <label for="i_model">Model: </label>
            <input type="text" id="i_model" name="model" value="<?php echo $v["model"]; ?>"/>
            <label for="i_price">Cijena: </label>
            <input type="text" id="i_price" name="price" value="<?php echo $v["price"]; ?>"/>
            <label for="i_year">Godina proizvodnje:</label>
            <input type="text" id="i_year" name="year" value="<?php echo $v["production_year"]; ?>"/>
            <table style="display: flex; justify-content: center; margin: 10px;">
                <tr>
                    <td>
                        <a id="back" href="../remove.php">Back</a>
                        <input type="submit" href="../remove.php" id="send" name="submit" value="Save"/>
                    </td>
                </tr>
            </table>
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

                    require("connect.php");
    
                    $stmt = $conn->prepare("update phones set manufacturer_id=:manufacturer_id, model=:model, price=:price, production_year=:year where phone_id = {$param}");
                    $stmt->bindParam(":manufacturer_id", $man_id);
                    $stmt->bindParam(":model", $model);
                    $stmt->bindParam(":price", $price);
                    $stmt->bindParam(":year", $year);
                    $stmt->execute();
    
                    if ($stmt) {
                        echo "Phone updated succesfully!";
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
</body>
</html>