<?php include("partials/menu.php");?>
<div class="whole center">
    <h1>Manage Food</h1>
    <br><br>
    <div class="main-content">
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br><br>
        <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['unauthorized'])) {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }
            if(isset($_SESSION['remove-failed'])) {
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }
            if(isset($_SESSION['edit'])) {
                echo $_SESSION['edit'];
                unset($_SESSION['edit']);
            }
        ?>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql);
                $sn = 1;
                if($res == true) {
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['ID'];
                            $title = $row['Title'];
                            $price = $row['Price'];
                            $image_name = $row['Image_Name'];
                            $featured = $row['Featured'];
                            $active = $row['Active'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $price;?></td>
                                    <td>
                                        <?php 
                                            if($image_name != "") {
                                                ?>
                                                <img src="<?php echo SITEURL . 'images/Food/' . $image_name?>" width="100px">
                                                <?php
                                            }else{
                                                echo "<div class='fail'>No image to preview. </div>";
                                            }
                                            ?>
                                    </td>
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="update-food.php?id=<?php echo $id;?>&image-name=<?php echo $image_name;?>" class="btn-secondary">Update Food</a>
                                        <a href="delete-food.php?id=<?php echo $id;?>&image-name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
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