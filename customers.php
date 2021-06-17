<?php 
    include "./database/dbconnection.php";
    session_start();
    
    if ( !isset($_SESSION["username"])) header('location:login.php');
    if ($_SESSION["username"] != "admin" ) header('location:index.php');
    
    $customerQ = "SELECT * FROM users WHERE username != 'admin'";
    $customers = mysqli_query($conn, $customerQ);
    $rows = mysqli_num_rows($customers);
    
?>
<?php 
    require "header.php";
?>

<div class="container admin">
    <div class="customers">
        <h2>Customers</h2>
        <?php 
            if ( $rows == false ) {
                echo "<p>No customers</p>";
            } else { 
                echo '<div>';
                echo "<TABLE BORDER='1' ALIGN=\"LEFT\">";
                echo "<TR>";
                echo "<TD>Username</TD>";
                echo "<TD>Email</TD>";
                echo "<TD>Phone</TD>";
                echo "</TR>";
                while ( $row = mysqli_fetch_array($customers) ) {
                    echo "<TR>";
                    echo "<TD>".$row['username']."</TD>";
                    echo "<TD>".$row['email']."</TD>";
                    echo "<TD>".$row['phone']."</TD>";
                    echo "</TR>";
                }
                echo '</div>';
            }
        ?>
    </div>
</div>