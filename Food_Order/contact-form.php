<?php
   
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //USING FILTERS
        $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
        $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
        //echo $user . "<br>" . $mail ."<br>" . $phone ."<br>" . $msg;
        /*
        if(strlen($user) < 4) {
            $userError = "<div style='color:red;'>Sorry username must not be less than 3 chars.</div>";
        }
        if(strlen($phone) < 11) {
            $phoneError = "<div style='color:red;'>Sorry phone number must not be less than 11 number.</div>";
        }
        if(strlen($msg) < 10) {
            $msgError = "<div style='color:red;'>Sorry message must not be less than 10 chars.</div>";
        }
        */
        
        $formerrors = array();
        if(strlen($user) < 4) {
            $formerrors[] = "Sorry username must not be less than <strong>3</strong> chars.";
        }
        
        if(strlen($phone) < 11) {
            $formerrors[] = "Sorry phone number must not be less than <strong>11</strong> number.";
        }
        
        if(strlen($msg) < 10) {
            $formerrors[] = "Sorry message must not be less than <strong>10</strong> chars.";
        }

        $myEmail = "awadhopefull@gmail.com";
        $subject = "Customer Complaint";
        $customerEmail = "From: " . $mail . "\r\n";
        if(empty($formerrors)) {
            
            //mail($myEmail, $subject, $msg, $customerEmail);
            $user = "";
            $mail = "";
            $msg = "";
            $phone = "";
            $success = "<div class='alert alert-success text-center'>We have received your message. </div>";
        }
        
    }
    
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-eqiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
        </title>
        <link rel="stylesheet" href="css-1/bootstrap.min.css">
        <link rel="stylesheet" href="css-1/font-awesome.min.css">
        <link rel="stylesheet" href="css-1/contact.css">
        
    </head>
    <body>

        <div class="container">
            <h1 class="text-center">Contact ME</h1>
            <form action="<?php echo ($_SERVER['PHP_SELF']);?>" method="POST" class="contact">
            <?php
            
                if(!empty($formerrors)) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="start">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    <?php
                    foreach($formerrors as $error) {
                        echo $error."<br>";
                    }
                    ?>
                    </div>
                    <?php
                }
                if(isset($success)) {
                    echo $success;
                }
            
            ?>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Type your name" class="form-control uservalid"
                    value="<?php if(isset($user)) {echo $user;}?>">
                    <i class="fa-sharp fa-solid fa-user fa fa-fw"></i>
                    <span class="astrix">*</span>
                    <div class="alert alert-danger usererror">
                        Sorry username must not be less than <strong>3</strong> chars.
                    </div>
                    <!--
                        if(isset($userError)) {
                            echo $userError;
                        }
                    -->

                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Type your email" class="form-control emailvalid"
                    value="<?php if(isset($mail)) {echo $mail;}?>">
                    <i class="fa-solid fa-envelope fa fa-fw"></i>
                    <span class="astrix">*</span>
                    <div class="alert alert-danger emailerror">
                        Sorry Email must not be empty.
                    </div>
                </div>
                <input type="text" name="mobile" placeholder="Insert your phone number" class="form-control"
                value="<?php if(isset($phone)) {echo $phone;}?>">
                
                <i class="fa-solid fa-phone fa fa-fw"></i>
                
                <!--
                    if(isset($phoneError)) {
                        echo $phoneError;
                    }
                -->
                <div class="form-group">
                    <textarea name="message" cols="30" rows="10" placeholder="Your message!" class="form-control messagevalid">
                    <?php if(isset($msg)) {echo $msg;}?>
                    </textarea>
                    <span class="astrix">*</span>
                    <div class="alert alert-danger msgerror">
                        Sorry message must not be less than <strong>10</strong> chars.
                    </div>
                </div>
                <!--
                    if(isset($msgError)) {
                        echo $msgError;
                    }
                -->
                
                <input type="submit" name="submit" class="btn btn-success submit">
                <i class="fa-sharp fa-solid fa-paper-plane fa fa-fw send-item"></i>
            </form>
        </div>
        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>
<?php
    //include("Partials/footer.php");
?>