<?php
if(!isset($_SESSION['user'])) {
    $_SESSION['no-login-user'] = "<div class='fail center'>Please Login first to access whole site</div>";
    header("location:" . SITEURL . "login.php");
}
?>