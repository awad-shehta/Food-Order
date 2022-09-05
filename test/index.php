<?php include("partials-front/menu.php");?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL . 'food-search.php';?>" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
    if(isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql = "SELECT * FROM tbl_category WHERE Featured = 'yes' AND Active = 'yes'";
                $res = mysqli_query($conn, $sql);
                if($res == true) {
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['ID'];
                            $title = $rows['Title'];
                            $image = $rows['Image_Name'];
                            
                                ?>
                                <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                    <div class="box-3 float-container">
                                        <?PHP 
                                        if($image != "") {
                                        // Path of image goes from old website due to paths update later
                                        ?>
                                        
                                        <img src="<?php echo SITEURL . '../Food_Order/images/category/' . $image;?>" alt="Pizza" class="img-responsive img-curve">

                                        <?PHP

                                        }

                                        ?>
                                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                                    </div>
                                </a>
                                <?php
                        }
                    }
                }else{
                    echo "<div style='color:red;'>No imgae to preview</div>";
                }
            
            ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql2 = "SELECT * FROM tbl_food WHERE Active = 'yes' AND Featured = 'yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2 > 0) {
                while($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['ID'];
                    $title = $row['Title'];
                    $description = $row['Description'];
                    $price = $row['Price'];
                    $image = $row['Image_Name'];
                    // Path of image goes from old website due to paths update later
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">

                        <?php
                        if($image != "") {
                            ?>
                            <img src="<?php echo SITEURL . '../Food_Order/images/Food/' . $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }else{
                            echo "<div style='color:red;'>No Food Image available</div>";
                        }
                        ?>

                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail">
                                <?php echo $description;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL . 'order.php?food_id=' . $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }else{
                echo "<div style='color:red;'>No Food available</div>";
            } 
           
            ?>

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php");?>   