<?php
    // TERMINATE SESSION
    session_start();    
    session_unset();
    session_destroy();
    header("location: homepage.html");
    exit();
?>