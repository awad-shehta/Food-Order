<?php
    include('partials/menu.php');
?>
<html>
    <head>
        <title>Add Category Page</title>
    </head>
    <body>
        <div class="main-content">
        <h1>Add Category</h1><br><br>
        <?php
            if(isset($_SESSION['category'])) {
                echo $_SESSION['category'];
                unset($_SESSION['category']);
            }
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <br><br>
            <div class="wrapper">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title</td>
                            <td>
                                <input type="text" name="title" placeholder="Category Title">
                            </td>
                        </tr>
                        <tr>
                            <td>Choose Image</td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <td>Featured</td>
                            <td>
                                <input type="radio" name="featured" value="yes">Yes <br>
                                <input type="radio" name="featured" value="no">No <br>
                            </td>
                        </tr>
                        <tr>
                            <td>Active</td>
                            <td>
                                <input type="radio" name="Active" value="yes">Yes <br>
                                <input type="radio" name="Active" value="no">No <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php
                if(isset($_POST['submit'])) {
                    $title = $_POST['title'];
                    if(isset($_POST['featured'])) {
                        $featured = $_POST['featured'];
                    }else{
                        $featured = "No";
                    }
                    if(isset($_POST['Active'])) {
                        $active = $_POST['Active'];
                    }else{
                        $active = "No";
                    }
                    //print_r($_FILES["image"]);
                    //die();
                    if($_FILES["image"]["name"]) {
                        $image_name = $_FILES["image"]["name"];
                        $ext = end(explode(".", $image_name));
                        $image_name = "Food_Category_" . rand(0,900) . "." . $ext;
                        if($image_name != "") {
                            $image_source = $_FILES["image"]["tmp_name"];
                            $image_destination = "images/category/" . $image_name;
                            $upload = move_uploaded_file($image_source, $image_destination);
                            if($upload == false) {
                                $_SESSION["upload"] = "<div class='fail'>Failed to upload image</div>";
                                header("location:" . SITEURL . "add-category.php");
                            }
                        }else{
                            echo "<div class='fail'>Image not found.</div>";
                        }
                    }
                    else{
                        $image_name = "";
                    }
                    $sql = "INSERT INTO tbl_category SET
                    Title = '$title',
                    Image_Name = '$image_name',
                    Featured = '$featured',
                    Active = '$active'";
                    $res = mysqli_query($conn, $sql);
                    if ($res == true) {
                        $_SESSION['category'] = "<div class= 'success center'>Category added successfully</div>";
                        header("location:" . SITEURL . "manage-category.php");
                    }else{
                        $_SESSION['category'] = "<div class= 'fail center'>Failed to add category</div>";
                        header("location:" . SITEURL . "add-category.php");
                    }
                }
            
            ?>
        </div>
    </body>
</html>





<?php
    include('partials/footer.php');
?>