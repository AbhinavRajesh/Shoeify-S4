<?php
    include "./database/dbconnection.php";
    require "header.php";

    if ( isset($_POST["name"]) ) {
        $name = $_POST["name"];
        $brand = $_POST["brand"];
        $price = $_POST["price"];
        $shoes = $_POST["shoes"];
        $image = $_POST["image"];
        $addQuery = "INSERT INTO shoes(`name`, brand, price, shoes, `image`) VALUES ('$name', '$brand', '$price', '$shoes', '$image')";
        if (!mysqli_query($conn, $addQuery)) {
            echo "<alert>Some error occured while adding the product</alert>";
        } else {
            $lastInsertedShoeId = mysqli_insert_id($conn);
        }
    }


?>

<div class="container addedProduct">
    <h2>Product added!</h2>
    <p>The entered product was added successfully!</p>
    <a href=<?php echo "product.php?q=". $lastInsertedShoeId; ?>>Check the product</a>
</div>

<?php 
    require "footer.php";
?>