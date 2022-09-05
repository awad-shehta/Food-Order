<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
        
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql2 = "SELECT * FROM tbl_food WHERE ID = $id";
                $res2 = mysqli_query($conn, $sql2);
                $count = mysqli_num_rows($res2);
                if($count > 0) {
                    $row2 = mysqli_fetch_assoc($res2);
                    $title2 = $row2['Title'];
                    $description = $row2['Description'];
                    $price = $row2['Price'];
                    $current_image = $row2['Image_Name'];
                    $current_category = $row2['Category_ID'];
                    $featured = $row2['Featured'];
                    $active = $row2['Active'];
                }
            }else{
                header("location:".SITEURL."manage-food.php");
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="col-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title2;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="25" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <img src="

                        <?php 
                            if($current_image == "") {
                                echo "<div class='fail'>No image to preview</div>";
                            }else{
                                echo SITEURL . "images/Food/" . $current_image;
                            }
                        ?>
                        " width="200px" name="">
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">

                            <?php
                                    $sql = "SELECT * FROM tbl_category WHERE Active='yes'";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                        if($count > 0) {
                                            while($row = mysqli_fetch_assoc($res)) {
                                                $title = $row['Title'];
                                                $category_id = $row['ID'];
                                                ?>
                                                    <option value="
                                                <?php 
                                                    echo $category_id;
                                                ?>
                                                " <?php 
                                                    if($category_id == $current_category) {
                                                        echo "selected";
                                                    }
                                                ?>>
                                                <?php echo $title;?></option>
                                                <?php
                                            }
                                        }
                                    
                                ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="yes"
                            <?php if($featured == "yes") {echo "checked";}?>>yes
                        <input type="radio" name="featured" value="no"
                            <?php if($featured == "no") {echo "checked";}?>>no
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="yes"<?php if($active == "yes") {echo "checked";}?>>yes
                        <input type="radio" name="active" value="no"<?php if($active == "no") {echo "checked";}?>>no
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            
            if(isset($_POST['submit'])) {
                $id = $_POST["id"];
                $title = $_POST['title'];
                $description = $_POST['description'];                        
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];

                if(isset($_FILES['image']['name'])) {
                    $new_image = $_FILES['image']['name'];
                    if($new_image != "") {
                        $extention = explode('.', $new_image);
                        $ext = end($extention);
                        $new_image = "Food_Image_" . rand(000, 888) . "." . $ext;
                        $source = $_FILES['image']['tmp_name'];
                        $destination = "images/Food/" . $new_image;
                        $upload = move_uploaded_file($source, $destination);
                        if($upload == false) {
                            $_SESSION['update'] = "<div class='fail'>Unable to upload Image. </div>";
                            header("location:".SITEURL."manage-food.php");
                            die();
                        }
                        if($current_image != "") {
                            $path = "images/Food/" . $current_image;
                            $remove = unlink($path);
                            if($remove == false) {
                                $_SESSION['remove-failed'] = "<div class='fail'>Unable to remove Image. </div>";
                                header("location:".SITEURL."manage-food.php");
                                die();
                            }
                        }
                    }
                }else{
                    $new_image = $current_image;
                }
                
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $sql3 = "UPDATE tbl_food SET
                Title = '$title',
                Description = '$description',
                Price = '$price',
                Image_Name = '$new_image',
                Category_ID = '$category',
                Featured = '$featured',
                Active = '$active' WHERE ID = $id";
                $res3 = mysqli_query($conn, $sql3);
                if($res3 == true) {
                    $_SESSION['edit'] = "<div class='success'>Updated Data successfully. </div>";
                    //header("location:".SITEURL."manage-food.php");
                    echo"<script>window.location.href='http://localhost/projects/Food_Order/manage-food.php';</script>";
                }else{
                    $_SESSION['edit'] = "<div class='fail'>Unable to update data. </div>";
                    //header("location:".SITEURL."manage-food.php");
                    echo"<script>window.location.href='http://localhost/projects/Food_Order/manage-food.php';</script>";
                }
            }            
        ?>
    </div>
</div>
<?php include("partials/footer.php");?>