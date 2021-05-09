<?php 
    include "./database/dbconnection.php";
    session_start();
    
    if ( !isset($_SESSION["username"]) ) header('location:login.php');
    if ($_SESSION["username"] != "admin" ) header('location:index.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>This is the admin dashboard</h1>
</body>
</html>