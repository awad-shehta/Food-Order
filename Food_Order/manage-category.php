<?php include("partials/menu.php");?>
<div class="whole center">
    <h1>Manage Category</h1>
    <br><br>
    <?php
            if(isset($_SESSION['category'])) {
                echo $_SESSION['category'];
                unset($_SESSION['category']);
            }
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['no-category'])) {
                echo $_SESSION['no-category'];
                unset($_SESSION['no-category']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['upload1'])) {
                echo $_SESSION['upload1'];
                unset($_SESSION['upload1']);
            }
            if(isset($_SESSION['unlink'])) {
                echo $_SESSION['unlink'];
                unset($_SESSION['unlink']);
            }
        ?>
        
        <br><br>
    <div class="main-content">
        <br><br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>
        <table class="tbl-full">
            
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if($count > 0) {
                    while($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['ID'];
                        $title = $rows['Title'];
                        $image_name = $rows['Image_Name'];
                        $featured = $rows['Featured'];
                        $active = $rows['Active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>

                            <td>
                                <?php 
                                    if(isset($image_name)) {
                                        ?>
                                        <div>
                                            <image src="images/category/<?php echo $image_name;?>" alt="" width="100px">
                                        </div>
                                        <?php
                                    }else{
                                        echo "<div>No Image </div>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                                <a href="update-category.php?id=<?php echo $id;?>&image-name=<?php echo $image_name;?>" class="btn-secondary">Update Category</a>
                                <a href="delete-category.php?id=<?php echo $id;?>&image-name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td>
                            <div class="fail">Sorry there is no items to preview. </div>
                        </td>
                    </tr>
                    <?php
                }
            
            ?>
            
          
        </table>             
    </div>
            
</div>
<?php include("partials/footer.php");?>   