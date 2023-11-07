<?php
    session_start();
    session_destroy();
    setcookie("uid","",1,'/');
    unset($_COOKIE["uid"]);
    header('Location: ../index.php');
?>