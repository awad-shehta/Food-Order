<?php include("partials/menu.php");?>
<head>
        <title></title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
<div class="whole center">
    <h1>Manage Admin</h1>
    <?php
        if(isset($_SESSION["Add"])) {
            echo $_SESSION["Add"];
            unset($_SESSION["Add"]);
        }
        if(isset($_SESSION["delete"])){
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }
        if(isset($_SESSION["update"])){
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }
        if(isset($_SESSION["changed"])){
            echo $_SESSION["changed"];
            unset($_SESSION["changed"]);
        }
    ?>
    <br><br>
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br><br><br>
    <div class="main-content">
           <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);
                if($res == true) {
                    $count = mysqli_num_rows($res);
                    $plus = 1;
                    if($count > 0) {

                        while($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['ID'];
                            $fullname = $rows['Fullname'];
                            $username = $rows['Username'];
                            ?>
                            <tr>
                                <td><?php echo $plus++;?></td>
                                <td><?php echo $fullname;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>update-password.php?id=<?php echo $id;?>" class="btn-primary">update password</a>
                                    <a href="<?php echo SITEURL;?>update-admin.php?id=<?php echo $id;?>" class="btn-secondary">update admin</a>
                                    <a href="<?php echo SITEURL;?>delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete admin</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>
            
        
           </table>     
    </div>
            
</div>
<?php include("partials/footer.php");?>   
