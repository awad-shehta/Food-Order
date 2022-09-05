<?php include('config/constants.php');?>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body style="background-color:#f7f6f6;">
        <div style=
           "margin: 5% auto;
            border: 1px solid black;
            padding: 3%;
            width: 30%;
            background-color: #F04B32;"
            class="login">
            <?php 
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-user'])) {
                echo $_SESSION['no-login-user'];
                unset($_SESSION['no-login-user']);
            }
            ?>
            <h1 class="center" style="color:white">Login</h1>
            <form action="" method="POST" class="center">
                <strong style="color:white">Username</strong>
                <input type="text" name="username" placeholder="E-mail or Username"><br><br>
                <strong style="color:white">Password</strong>
                <input type="password" name="password" placeholder="password"><br><br><br>
                <input type="submit" name="login" value="login" class="center btn-secondary submit" >
            </form>
            <p class="center" style="color:white">Created by <a href="">awad shehta</a></p>
        </div>
    </body>
</html>
<?php
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM tbl_admin WHERE Username = '$username' AND Password = '$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1) {
            $_SESSION['login'] = "<div class='success center'>Welcome $username</div>";
            $_SESSION['user'] = $username;
            header("location:" . SITEURL . "index.php");
            
        }else{
            $_SESSION['login'] = "<div class='fail center'>username or password incorrect</div>";
            header("location:" . SITEURL . "login.php");
        }
    }
?>