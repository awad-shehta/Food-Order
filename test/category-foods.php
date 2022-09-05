<?php include("partials-front/menu.php");?>
<?php
    if(isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $sql = "SELECT Title FROM tbl_category WHERE ID = $category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $title = $row['Title'];
    }else{
        header('location' . SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql2 = "SELECT * FROM tbl_food WHERE Category_ID = $category_id";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2 > 0) {
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['ID'];
                        $title = $row2['Title'];
                        $price = $row2['Price'];
                        $description = $row2['Description'];
                        $image = $row2['Image_Name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image != "") {
                                        ?>
                                        <img src="<?php echo SITEURL . '../Food_Order/images/Food/' . $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }else{
                                        echo "<div style='color:red;'>Sorry there is no Image to preview.</div>";
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

                                <a href="<?php echo SITEURL . 'order.php?food_id=' . $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo "<div style='color:red;'>Sorry there is no food available now</div>";
                }
            
            ?>

            

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php");?>