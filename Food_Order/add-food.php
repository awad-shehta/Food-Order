<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <?php
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Write your title of food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="25" rows="5" placeholder="write your description here"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                
                    <td>
                        <select name="category" id="">
                        <?php
                            $sql = "SELECT * FROM tbl_category WHERE Active='yes'";
                            $res = mysqli_query($conn, $sql);
                            if($res == true) {
                                $count = mysqli_num_rows($res);
                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['ID'];
                                        $title = $row['Title'];
                                        ?>
                                        <option value="<?php echo $id;?>"> <?php echo $title;?> </option>
                                        <?php
                                    }
                                }else{
                                        ?>
                                        <option value="0"> No Category </option>
                                        <?php
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">no
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">no
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                if(isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    if($image_name != "") {
                        $ext = end(explode(".", $image_name));
                        $image_name = "Food_Image_".rand(0, 999).".".$ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dest = "images/Food/".$image_name;
                        $upload = move_uploaded_file($src, $dest);
                        if($upload == false) {
                            $_SESSION['upload'] = "<div class='fail'>Failed to upload image. </div>";
                            header("location:".SITEURL."add-food.php");
                            die();
                        }
                        //echo $image_name;
                    }
                }else{
                    $image_name = "";
                }
                $category = $_POST['category'];
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                }else{
                    $featured = "no";
                }
                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                }else{
                    $active = "no";
                }
                $sql2 = "INSERT INTO tbl_food SET
                Title = '$title',
                Description = '$description',
                Price = $price,
                Image_Name = '$image_name',
                Category_ID = '$category',
                Featured = '$featured',
                Active = '$active'";
                $res2 = mysqli_query($conn, $sql2);
                if($res == true) {
                    $_SESSION['add'] = "<div class='success'>Data inserted successfully</div>";
                    header("location:" . SITEURL . "manage-food.php");
                }else{
                    $_SESSION['add'] = "<div class='fail'>Failed to insert Data</div>";
                    header("location:" . SITEURL . "manage-food.php");
                }
            }
            
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>
