<?php
include("partials/menu.php");

?>
<div class="main-content">
    <h1>Update Admin</h1>
    <?php
        $id = $_GET['id'];
        //echo($id);
        $sql = "SELECT * FROM tbl_admin WHERE ID=$id";
        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $count = mysqli_num_rows($res);
            if($count == 1){
                $row = mysqli_fetch_assoc($res);
                $fullname = $row['Fullname'];
                $username = $row['Username'];
            }
            header("location" . SITEURL . "manage-admin.php");
        }else{

            header("location" . SITEURL . "manage-admin.php");
        }
    ?>
    <div class="wrapper">
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Fullname</td>
                    <td><input type="text" name="full-name" value="<?php echo $fullname;?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>"></td>
                </tr>
                <tr colspan="2">
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST["submit"])) {
    $id = $_POST["id"];
    $fullname = $_POST["full-name"];
    $username = $_POST["username"];
    $sql = "UPDATE tbl_admin SET
    Fullname = '$fullname',
    Username = '$username'
    WHERE ID = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res == true) {
        $_SESSION["update"] = "<div class='success'>tbl_admin has been updated</div>";
        header("location:" . SITEURL . "manage-admin.php");
    }else{
        $_SESSION["update"] = "<div class='fail'>Failed to update tbl_admin</div>";
        header("location:" . SITEURL . "../manage-admin.php");
    }
}
include("partials/footer.php");
?>