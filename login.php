<?php 

    include "./database/dbconnection.php";
    session_start();
    
    
    if ( !$conn ) echo "Connection to db was unsuccessful";
    if (isset($_SESSION['username'])) header("location:index.php");

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    if ( $username && $password ) {
      $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $result = mysqli_query($conn, $query);

      if ( mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("location:index.php");
        $error = "Login Successfull";
      } else {
        $error = "Invalid username or password";
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
      <form method="POST" action="#">
        <h2>Login</h2>
        <?php
          if ( $error ) echo "<span class='errorMessage''>" . $error . "</span>";
        ?>
        <label for="username">Username</label>
        <input required type="text" name="username" id="username" />
        <label for="password">Password</label>
        <input required type="password" name="password" id="password" />
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="./signup.php" class="linkLoginSignup">Create now for free</a></p>
      </form>
    </div>
    <?php 
      include("./footer.php");
    ?>
  </body>
</html>
