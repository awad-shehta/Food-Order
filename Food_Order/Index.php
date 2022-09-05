<?php include("partials/menu.php");?>
        <div class="whole center">
            <h1>Dashboard</h1>
            <?php 
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
            <div class="main-content">
                <div class="col-4">
                    <?php 
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    echo "<h1>$count</h1>";
                    ?>
                    Category
                </div>
                <div class="col-4">
                    <?php 
                    $sql2 = "SELECT * FROM tbl_food";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    echo "<h1>$count2</h1>";
                    ?>
                    Food
                </div>
                <div class="col-4">
                    <?php 
                    $sql3 = "SELECT * FROM tbl_order";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    echo "<h1>$count3</h1>";
                    ?>
                    Total Orders
                </div>
                <div class="col-4">
                    <?php 
                    // important sql query
                    $sql4 = "SELECT sum(Total) AS Result FROM tbl_order WHERE Status = 'delivered'";
                    $res4 = mysqli_query($conn, $sql4);
                    $row = mysqli_fetch_assoc($res4);
                    $count4 = $row['Result'];
                    echo "<h1>$ $count4</h1>";
                    ?>
                    Revenu Generated
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
<?php include("partials/footer.php");?>       