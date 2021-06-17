<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./static/styles/form.css" />
    <link rel="stylesheet" href="./static/styles/main.css" />
    <title>Shoeify</title>
  </head>
  <body>
    <header>
      <nav class="navbar">
        <div class="logo">
          <h1><a href="index.php">Shoeify</a></h1>
        </div>
        <ul class="nav-links">
          <?php
            if ( !$_SESSION["username"] ) {
          ?>
              <a href="./signup.php">
                <li class="nav-link">Sign up</li>
              </a>
              <a href="./login.php">
                <li class="nav-link">Login</li>
              </a>
          <?php
            } else {
          ?>
              <p>Welcome back, <?php echo $_SESSION["username"];?></p>
              <?php if ($_SESSION["username"] == "admin" ) { ?><a href='./customers.php'><li class="nav-link">Customers</li></a><?php } ?>
              <a href="./logout.php">
                <li class="nav-link">Logout</li>
              </a>
          <?php
            }
          ?>
          <a href="#" onclick="toggleDarkMode()">
            <li class="nav-link" id="dark-mode">Dark</li>
          </a>
        </ul>
      </nav>
    </header>