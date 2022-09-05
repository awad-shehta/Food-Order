<?php include("partials/menu.php");?>
<div class="main-content">
    <h1>Add Admin</h1>
    <div class="wrapper">
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name</td>
                    <td><input type="text" name="full-name" placeholder="Enter your full name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td  colspan="2">
                        <input type="submit" value="Add Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>

                <tr></tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php");?>
<?php
if(isset($_POST['submit'])) {
    $fullname = $_POST['full-name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO tbl_admin SET 
    Fullname='$fullname',
    Username='$username',
    Password='$password'";
    
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($res == true) {
        $_SESSION["Add"] = "<div class='success'>Admin inserted successfully</div>";
        header("location:" . SITEURL . "manage-admin.php");
    }
    else{
        $_SESSION["Add"] = "Failed to add admin user";
        header("location:" . SITEURL . "manage-admin.php");
    }
    
}


?>