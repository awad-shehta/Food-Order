<?php include("partials-front/menu.php");?>
<?php
if(isset($_GET['food_id'])) {
$id = $_GET['food_id'];
$sql = "SELECT * FROM tbl_food WHERE ID = $id";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if($count > 0) {
$row = mysqli_fetch_assoc($res);
$title = $row['Title'];
$price = $row['Price'];
$image = $row['Image_Name'];

}else{
    
    header("location:" . SITEURL);
}
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image != "") {
                            ?>
                            <img src="<?php echo SITEURL . '../Food_Order/images/Food/' . $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }else{
                            echo "<div style='color:red;'>There is no image available</div>";
                        }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
                
                <?php
                if(isset($_POST['submit'])) {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $qty * $price;
                    $order_date = Date("Y-m-d h:i:sa");
                    $status = "ordered";
                    $customer_name= $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $sql2 = "INSERT INTO tbl_order SET
                    Food = '$food',
                    Price = $price,
                    QTY = $qty,
                    Total = $total,
                    Order_Date = '$order_date',
                    Status = '$status',
                    Customer_Name = '$customer_name',
                    Customer_Contact = '$customer_contact',
                    Customer_Email = '$customer_email',
                    Customer_Address = '$customer_address'";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == true) {
                        $_SESSION['order'] = "<div style='color:green;text-align:center;padding:2%'>Food ordered successfully.</div>";
                        header("location:" . SITEURL);
                    }else{
                        $_SESSION['order'] = "<div style='color:red;text-align:center;padding:2%'>Failed to make order.</div>";
                        header("location:" . SITEURL);
                    }
                }
                ?>

            </form>
            

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("partials-front/footer.php");?>