<?php include("partials-front/menu.php");?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            
            $sql = "SELECT * FROM tbl_food WHERE Title LIKE '$search' OR description LIKE '$search'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['ID'];
                    $title = $row['Title'];
                    $price = $row['Price'];
                    $description = $row['Description'];
                    $image = $row['Image_Name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            if($image != "") {
                                ?>
                                <img src="<?php echo SITEURL . '../Food_Order/images/Food/' . $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }else{
                                echo "<div style='color:red;'>No Image available</div>";
                            }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price . '$';?></p>
                            <p class="food-detail">
                            <?php echo $description;?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }else{
                echo "<div style='color:red;'>No such Food similar to your search</div>";
            }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php");?>