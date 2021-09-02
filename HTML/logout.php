<?php
    session_start();
    $_SESSION['nome']="";
    $_SESSION['is_admin']="";
    session_destroy();
    
    header("Location: home.php");
?>