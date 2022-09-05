<?php include("config/constants.php");?>
<?php
    if(isset($_GET['id']) && isset($_GET['image-name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image-name'];
        if($image_name != "") {
            $path = "images/Food/" . $image_name;
            $remove = unlink($path);
            if($remove == false) {
                $_SESSION['upload'] = "<div class= 'error'>Unable to remove image. </div>";
                header("location:" . SITEURL . "manage-food.php");
                die();
            }
        }
        $sql = "DELETE FROM tbl_food WHERE ID = $id";
        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $_SESSION['delete'] = "<div class= 'success'>data deleted successfully. </div>";
            header("location:" . SITEURL . "manage-food.php");
        }else{
            $_SESSION['delete'] = "<div class= 'error'>unable to delete data. </div>";
            header("location:" . SITEURL . "manage-food.php");
        }
    }else{
        $_SESSION["unauthorized"] = "<div class= 'error'>Unable to delete. </div>";
        header("location:" . SITEURL . "manage-food.php");
    }
?>