<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phones</title>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
    <div id="wrap">
        <div id="result_set">
            <?php

            require ("include/connect.php");
            $res = $conn->query("select * from phones join manufacturers on phones.manufacturer_id = manufacturers.manufacturer_id");
            foreach ($res as $value) {
                ?>
                <div id="items">
                    <div id="p_cont" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:0.8em; color:white">
                        <p class="result"><b>Name:</b><?php echo " " . $value['name'] . " " . $value['model']; ?></p>
                        <p class="result"><b>Price:</b><?php echo " " . $value['price']; ?></p>
                        <p class="result"><b>Year:</b> <?php echo " " . $value['production_year']; ?></p>
                    </div>
                    <div id="a_cont">
                        <a class="custom" href="include/removePhone.php?id=<?php echo $value["phone_id"]?>">Delete Phone</a>
                        <a class="custom" href="include/editPhone.php?id=<?php echo $value["phone_id"]?>">Edit Phone</a>
                    </div>
                </div>
                <?php
            }
            ?>
            <div id="formContainer" style="display: none;">
                <form class="editForm" name="insert" action="#" method="post">
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
        </div>
        <div>
            <a id="back" class="custom" href="index.php">Back</a>
        </div>
    </div>
</body>
</html>