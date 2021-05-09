<?php 
    session_start();
    if (!isset($_SESSION["username"])) header("location:login.php");
    if ($_SESSION["username"] == "admin" ) header('location:admin.php');

?>

<!-- Header -->
<?php
    include("header.php")
?>

<!-- Landing -->
<?php
    include("./Template/_landing.php");
?>

<!-- Latest Shoes -->
<?php
    include("./Template/_latest-shoe.php");
?>

<!-- Footer -->
<?php
    include("footer.php");
?>