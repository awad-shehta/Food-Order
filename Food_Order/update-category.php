<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE ID = '$id'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['Title'];
                    $current_image = $row['Image_Name'];
                    $featured = $row['Featured'];
                    $active = $row['Active'];
                }else{
                    $_SESSION['no-category'] = "<div class='fail'>Category not found</div>";
                    header("location:" . SITEURL . "manage-category.php");
                }
            }
            else{
                header("location:" . SITEURL . "manage-category.php");
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr> 
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr> 
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != "") {
                                ?>
                                <img src="<?php echo SITEURL . 'images/category/' . $current_image;?>" width="200px">
                                <?php
                            }else{
                                echo "<div class='fail'>Image not found</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr> 
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr> 
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured == "yes") { echo "checked"; }?> type="radio" name="featured" value="yes">yes
                        <input <?php if($featured == "no") { echo "checked"; }?> type="radio" name="featured" value="no">no

                    </td>
                </tr>
                <tr> 
                    <td>Active</td>
                    <td>
                        <input <?php if($active == "yes") { echo "checked";}?> type="radio" name="active" value="yes">yes
                        <input <?php if($active == "no") { echo "checked";}?> type="radio" name="active" value="no">no
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])) {
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];





                if($_FILES['image']['name']) {
                    $image_name = $_FILES['image']['name'];
                    $ext = end(explode('.', $image_name));
                    $image_name = "Food_Category_" . rand(0, 900) . "." . $ext;
                    if($image_name != "") {
                        $image_source1 = $_FILES['image']['tmp_name'];
                        $image_destination1 = "images/category/" . $image_name;
                        $upload = move_uploaded_file($image_source1, $image_destination1);
                        if($upload == false) {
                            $_SESSION['upload1'] = "<div class='fail'>Failed to upload image.</div>";
                            header("location:".SITEURL."manage-category.php");
                        }
                        if($current_image != "") {
                            $remove_path = "images/category/" . $current_image;
                            $remove = unlink($remove_path);
                            if($remove == false) {
                                $_SESSION['unlink'] = "<div class='fail'>Failed to remove current image.</div>";
                                header("location:".SITEURL."manage-category.php");
                                //die();
                            }
                        }
                        
                    }
                    else{
                        $image_name = $current_image;
                    }
                }




                else{
                        $image_name = "$current_image";
                    }
                $sql2 = "UPDATE tbl_category SET
                    Title = '$title',
                    Image_Name = '$image_name',
                    Featured = '$featured',
                    Active = '$active' WHERE ID = '$id'
                ";
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == true) {
                    $_SESSION['update'] = "<div class='success'>Data updated successfully</div>";
                    header("location:" . SITEURL . "manage-category.php");
                }else{
                    $_SESSION['update'] = "<div class='fail'>Unable to update data</div>";
                    header("location:" . SITEURL . "manage-category.php");
                }
            }
?>
    </div>
</div>
<?php include("partials/footer.php");?>