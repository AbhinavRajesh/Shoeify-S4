<?php 
    include "./database/dbconnection.php";
    session_start();
    
    if ( !$conn ) echo "Connection to db was unsuccessful";
    if (isset($_SESSION['username'])) header("location:index.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $confirmPassword = $_POST["confirmPassword"];
    if ( $username ) {
      if ( $password == $confirmPassword ) {
        $password = md5($password);
        $confirmPassword = md5($confirmPassword);
        
        $query = "INSERT INTO users (username, `password`, email, phone) VALUES ('$username', '$password', '$email', '$phone')";
        
        if ( mysqli_query($conn, $query) ) {
          $_SESSION['username'] = $username;
          header('location:index.php');
        } else {
          $error = "Some error occured while registering. Please try again later";
        }
      } else {
        $error = "Password do not match!";
      }
    }    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./static/styles/form.css" />
    <link rel="stylesheet" href="./static/styles/main.css" />
    <title>Login</title>
  </head>
  <body>
    <?php 
      include("./header.php");
    ?>
    <div class="loginSignupContainer">
      <form method="POST" action="./signup.php">
        <h2>Signup</h2>
        <?php
          if ( $error ) echo "<span class='errorMessage'>" . $error . "</span>";
        ?>
        <label for="email">Email</label>
        <input required type="text" name="email" id="email" />
        <label for="username">Username</label>
        <input required type="text" name="username" id="username" />
        <label for="phone">Phone Number</label>
        <input required type="text" name="phone" id="phone" />
        <label for="password">Password</label>
        <input required type="password" name="password" id="password" />
        <label for="confirmPassword">Confirm Password</label>
        <input required type="password" name="confirmPassword" id="confirmPassword" />
        <button type="submit">Signup</button>
        <p>Already have an account? <a href="./login.php" class="linkLoginSignup">Login</a></p>
      </form>
    </div>
    <?php 
      include("./footer.php");
    ?>
  </body>
</html>
