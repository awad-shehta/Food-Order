<?php
    include("config/constants.php");
    if(isset($_GET['id']) && isset($_GET['image-name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image-name'];
        $sql = "DELETE FROM tbl_category WHERE ID = $id";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully. </div>";
            header("location:" . SITEURL . "manage-category.php");
        }
        else
        {
            $_SESSION['delete'] = "<div class='fail'>Failed to delete category. </div>";
            header("location:" . SITEURL . "manage-category.php");
        }
        if($image_name != "") {
            $path = "images/category/".$image_name;
            $remove = unlink($path);
            if($remove == false) {
                echo $path;
                $_SESSION['remove'] = "<div class='fail'>Failed to remove image. </div>";
                
                header("location:" . SITEURL . "manage-category.php");
                //die();
            }
        }
    }



?>