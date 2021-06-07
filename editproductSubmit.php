<?php
    include "./database/dbconnection.php";

    if ( isset($_POST["name"]) ) {
        $name = $_POST["name"];
        $brand = $_POST["brand"];
        $price = $_POST["price"];
        $shoes = $_POST["shoes"];
        $image = $_POST["image"];
        $addQuery = "UPDATE shoes SET `name` = '$name', brand = '$brand', price = $price, shoes = $shoes, `image`= '$image' WHERE id = " . $_GET["q"];
        if (!mysqli_query($conn, $addQuery)) {
            echo $addQuery;
            echo "<alert>Some error occured while editing the product</alert>";
            echo mysqli_error($conn);
        } else {
            header('location:admin.php');
        }
    }
?>