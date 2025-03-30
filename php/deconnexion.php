<?php
    session_start();
    session_destroy(); //détruit la session en court
    header("Location: main.php"); 
    exit();
?>