<?php
    include "./database/dbconnection.php";
    session_start();
    if ( !isset($_SESSION["username"]) ) header('location:login.php');
    require "header.php";

    $q = "SELECT * FROM shoes WHERE id = " . $_GET["q"];
    $shoe = mysqli_query($conn, $q);

    $adminQ = "SELECT * FROM users WHERE username = 'admin'";
    $admin = mysqli_query($conn, $adminQ);
    $rows = mysqli_num_rows($shoe);
?>

<main class="container productPage">
    <?php 
        if ( $rows == false ) {
    ?>  
        <div>No shoe exist with the id of <?php echo $_GET["q"]?></div>
    <?php 
        } else {
    ?>
    <?php while ($row = mysqli_fetch_array($shoe)) { ?>
        <h2><?php echo $row["name"]; ?></h2>
        <div class="productWrapper">
            <div class="productPageLeft">
                <img src=<?php echo $row["image"]; ?> alt=<?php echo $row["name"]; ?> />
            </div>
            <div class="productPageRight">
                <div class="productDesc">
                    <span>Shoe Name</span>
                    <span>: <?php echo $row["name"]; ?></span>
                </div>
                <div class="productDesc">
                    <span>Brand</span>
                    <span>: <?php echo $row["brand"]; ?></span>
                </div>
                <div class="productDesc">
                    <span>Price</span>
                    <span>: <?php echo $row["price"]; ?></span>
                </div>
                <div class="productDesc">
                    <span>Availability</span>
                    <?php echo $row["shoes"] > 0 ? "<span class='available'>: Available</span>" : "<span class='outofstock'>: Out of stock</span>"; ?>
                </div>
                <?php while ( $adminRow = mysqli_fetch_array($admin)) {?>
                    <div class="productDesc">
                        <span>Phone</span>
                        <span>: <a href=<?php echo "tel:" . $adminRow["phone"]; ?>><?php echo $adminRow["phone"]; ?></a></span>
                    </div>
                    <div class="productDesc">
                        <span>Email</span>
                        <span>: <a href=<?php echo "mailto:" . $adminRow["email"]; ?>><?php echo $adminRow["email"]; ?></a></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php 
            }
        }
    ?>
</main>

<?php
    include("footer.php");
?>