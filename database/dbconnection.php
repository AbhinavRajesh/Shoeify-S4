<?php
    $conn = mysqli_connect("localhost", "shoeify", "Password@123", "shoeify") or die("Some error occured while connecting to db!");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>