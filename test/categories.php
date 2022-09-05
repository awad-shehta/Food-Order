<?php include("partials-front/menu.php");?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            $sql = "SELECT * FROM tbl_category WHERE Active = 'yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['ID'];
                    $title = $row['Title'];
                    $image = $row['Image_Name'];
                    // Path of image goes from old website due to paths update later
                    ?>
                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                        <?php
                        if($image != "") {
                            ?>
                            <img src="<?php echo SITEURL . '../Food_Order/images/category/' . $image;?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                        }else{
                            echo "<div style='color:red;'>No Image to preview</div>";
                        }
                        ?>

                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>
                    <?php
                }
            }else{
                echo "<div style='color:red;'>No Category available</div>";
            }
            ?>
            



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include("partials-front/footer.php");?>