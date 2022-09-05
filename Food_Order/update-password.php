<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current-password" placeholder="current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new-password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm-password" placeholder="confirm password">
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <input type="submit" name="change-password"  class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['change-password'])) {
    $id = $_GET["id"];
    $current = md5($_POST["current-password"]);
    $new = md5($_POST["new-password"]);
    $confirm = md5($_POST["confirm-password"]);
    $sql = "SELECT * FROM tbl_admin WHERE ID=$id AND Password='$current'";
    $res = mysqli_query($conn, $sql);
    if($res == true) {
        $count = mysqli_num_rows($res);
        if($count == 1) {
            if($new == $confirm) {
                $sql2 = "UPDATE tbl_admin SET
                Password='$new' WHERE ID=$id";
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == true) {
                    $_SESSION['Done'] = "Password changed successfully";
                    header("location:" . SITEURL . "manage-admin.php");
                }else{
                    $_SESSION['Done'] = "Password not match";
                    header("location:" . SITEURL . "manage-admin.php");
                }
            }
         } else {
            $_SESSION["changed"] = "<div class='fail'>Password not changed</div>";
            header("location:" . SITEURL . "manage-admin.php");
        }  
    }     
}
?>
<?php include("partials/footer.php");?>