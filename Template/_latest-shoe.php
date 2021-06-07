<?php 
    include "./database/dbconnection.php";
    session_start();
    
    if ( !isset($_SESSION["username"]) ) header('location:login.php');
    
    $pq = "SELECT * FROM shoes";
    $products = mysqli_query($conn, $pq);
    echo mysqli_error($conn);
    $rows = mysqli_num_rows($products);

?>

<section id="latest-shoes" class="container latest">
    <div class="latest-top">
    <h2>Latest Shoes in the store</h2>
    </div>
    <?php 
        if ( $rows == false ) {
            echo "<p>No shoes added</p>";
        } else { 
            echo '<div class="item-list">';
            while ( $row=mysqli_fetch_array($products)) { 
    ?>
                <div class="item">
                    <a href=<?php echo "product.php?q=" . $row["id"]; ?>>
                        <img
                            src=<?php echo $row["image"];?>
                            class="shoe-image"
                            alt="shoe"
                        />
                        <div class="item-desc">
                            <p><?php echo $row["name"];?></p>
                            <span><?php echo $row["brand"];?></span>
                            <p>&#8377;<?php echo $row["price"];?></p>
                            <p>Qty: <?php echo $row["shoes"];?></p>
                        </div>
                    </a>
                </div>
    <?php
            }
            echo '</div>';
        }
    ?>
</section>