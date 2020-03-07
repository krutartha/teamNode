<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['username'])) {
        
        $_SESSION['msg'] = "You must log in first";
        header("location: ../html/login.html");
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../../html/login.html");
    }
    ?>