<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1><br><br>
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE ID =  $id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count > 0) {
                $row = mysqli_fetch_assoc($res);
                $food = $row['Food'];
                $price = $row['Price'];
                $qty = $row['Qty'];
                $status = $row['Status'];
                $cName = $row['Customer_Name'];
                $cContact = $row['Customer_Contact'];
                $cEmail = $row['Customer_Email'];
                $cAddress = $row['Customer_Address'];

            }
        }else{
            header("location:" . SITEURL . 'manage-order.php');
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food;?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo $price . " $";?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="Qty" value="<?php echo $qty;?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" >
                            <option value="ordered" <?php if ($status == "ordered") {echo "selected";}?>>Ordered</option>
                            <option value="on delivery" <?php if ($status == "on delivery") {echo "selected";}?>>On delivery</option>
                            <option value="delivered" <?php if ($status == "delivered") {echo "selected";}?>>Delivered</option>
                            <option value="cancelled" <?php if ($status == "cancelled") {echo "selected";}?>>Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="cname" value="<?php echo $cName;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="ccontact" value="<?php echo $cContact;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="cmail" value="<?php echo $cEmail;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea type="text" name="caddress" cols="20" rows="5">
                            <?php echo $cAddress;?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
            $price = $_POST['price'];
            $quantity = $_POST['Qty'];
            $total = $price * $quantity;
            $nStatus = $_POST['status'];
            $name = $_POST['cname'];
            $contact = $_POST['ccontact'];
            $email = $_POST['cmail'];
            $address = $_POST['caddress'];
            $sql2 = "UPDATE tbl_order SET
            Qty = $quantity,
            Total = $total,
            Status = '$nStatus',
            Customer_Name = '$name',
            Customer_Contact = '$contact',
            Customer_Email = '$email',
            Customer_Address = '$address'
            WHERE ID = $id";
            $res2 = mysqli_query($conn, $sql2);
            if($res2 == true) {
                $_SESSION['update'] = "<div style='color:green;text-align:center'>Order updated successfully</div>";
                header("location:" . SITEURL . 'manage-order.php');
            }else{
                $_SESSION['update'] = "<div style='color:red;text-align:center'>Order could not be updatd.</div>";
                header("location:" . SITEURL . 'manage-order.php');
            }
        }
        ?>
    </div>
</div>

<?php include("partials/footer.php");?>