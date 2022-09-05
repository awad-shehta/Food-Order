<?php
include("config/constants.php");
$id = $_GET['id'];
//echo($id);
$sql = "DELETE FROM tbl_admin WHERE ID=$id";
$res = mysqli_query($conn, $sql);
if($res == true) {
    $_SESSION["delete"] = "<div class='success'>Admin deleted successfully</div>";
    header("location:" . SITEURL . "manage-admin.php");
}else{
    $_SESSION["delete"] = "<div class='fail'>Failed to delete admin</div>";
    header("location:" . SITEURL . "manage-admin.php");
}

?>