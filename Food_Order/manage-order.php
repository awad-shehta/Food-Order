<?php include("partials/menu.php");?>
<div class="whole center">
    <h1>Manage Order</h1>
    <br><br>
    <?php
    if(isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    ?>
    <div class="main-content">
        
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Total</th>
                <th>Order_Date</th>
                <th>Status</th>
                <th>Customer_Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
                $counter = 1;
                $sql = "SELECT * FROM tbl_order ORDER BY ID DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['ID']; 
                        $food = $row['Food'];
                        $price = $row['Price'];
                        $qty = $row['Qty'];
                        $total = $row ['Total'];
                        $date = $row['Order_Date'];
                        $status = $row['Status'];
                        $cName = $row['Customer_Name'];
                        $cContact = $row['Customer_Contact'];
                        $cEmail = $row['Customer_Email'];
                        $cAddress = $row['Customer_Address'];
                        ?>
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $date;?></td>

                            
                                <?php
                                 if($status == "ordered") {
                                    echo "<td>$status<td>";
                                 }elseif($status == "on delivery") {
                                    echo "<td style='color:orange;'>$status<td>";
                                 }elseif($status == "delivered") {
                                    echo "<td  style='color:green;'>$status<td>";
                                 }else{
                                    echo "<td  style='color:red;'>$status<td>";
                                 }
                                ?>
                            

                            <td><?php echo $cName;?></td>
                            <td><?php echo $cContact;?></td>
                            <td><?php echo $cEmail;?></td>
                            <td><?php echo $cAddress;?></td>
                            <td>
                                <a href="<?php echo SITEURL . 'update-order.php?id=' . $id;?>" class="btn-secondary">update Food</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    echo "<div style='color:red; text-align:center'>Sorry you have no order yet.</div>";
                }
            ?>
        
        </table>            
    </div>
            
</div>
<?php include("partials/footer.php");?>   