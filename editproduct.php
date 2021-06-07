<?php
    include "./database/dbconnection.php";
    require "header.php";

    $q = "SELECT * FROM shoes WHERE id = " . $_GET["q"];
    $shoe = mysqli_query($conn, $q);
    $rows = mysqli_num_rows($shoe);
?>

<div class="container editProduct">
    <?php 
        if ( $rows == false ) {
    ?>  
        <div>No shoe exist with the id of <?php echo $_GET["q"]?></div>
    <?php 
        } else {
    ?>   
    <h2>Edit Product <?php echo $_GET["q"]; ?></h2>
    <?php while ($row = mysqli_fetch_array($shoe)) { ?>
        <form method="POST" action=<?php echo "./editproductSubmit.php?q=" . $_GET["q"] ?> >
            <label for="name" >Shoe name</label>
            <input required type="text" id="name" name="name" value=<?php echo $row["name"]; ?> />
            <label for="brand">Brand</label>
            <input required type="text" id="brand" name="brand" value=<?php echo $row["brand"]; ?> />
            <label for="price">Price</label>
            <input required type="text" id="price" name="price" value=<?php echo $row["price"]; ?> />
            <label for="shoes">Number of shoes available</label>
            <input required type="text" id="shoes" name="shoes" value=<?php echo $row["shoes"]; ?> />
            <label for="image">Enter link of shoe's image</label>
            <input required type="text" id="image" name="image" value=<?php echo $row["image"]; ?> />
            <button type="submit">Update Shoe</button>
        </form>
    <?php 
            }
        }
    ?>
</div>

<?php 
    require "footer.php";
?>