<?php 
    include "./database/dbconnection.php";
    session_start();
    
    if ( !isset($_SESSION["username"]) ) header('location:login.php');
    if ($_SESSION["username"] != "admin" ) header('location:index.php');
    
    $pq = "SELECT * FROM shoes";
    $products = mysqli_query($conn, $pq);
    $rows = mysqli_num_rows($products);
?>
<?php 
    require "header.php";
?>
<div class="container admin">
    <div class="addShoe">
        <h1>Add Shoes</h1>
        <form method="POST" action="./productAdded.php">
            <label for="name" >Shoe name</label>
            <input required type="text" id="name" name="name" />
            <label for="brand">Brand</label>
            <input required type="text" id="brand" name="brand" />
            <label for="price">Price</label>
            <input required type="text" id="price" name="price" />
            <label for="shoes">Number of shoes available</label>
            <input required type="text" id="shoes" name="shoes" />
            <label for="image">Enter link of shoe's image</label>
            <input required type="text" id="image" name="image" />
            <button type="submit">Add Shoe</button>
        </form>
    </div>
    <div class="products">
    <h2>Edit added products</h2>
        <?php 
            if ( $rows == false ) {
                echo "<p>No shoes added</p>";
            } else { 
                echo '<div class="item-list">';
                while ( $row=mysqli_fetch_array($products)) { 
                    ?>
                    <div class="item">
                        <a href=<?php echo "editproduct.php?q=" . $row["id"]; ?>>
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
    </div>
</div>

<?php
    require "footer.php";
?>