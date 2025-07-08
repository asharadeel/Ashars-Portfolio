<?php
    //IF USER IS NOT LOGGED IN, REDIRECT TO LOGIN PAGE, ELSE REDIREDECT TO ADD ENTRY PAGE
    session_start(); 

    if (isset($_SESSION['email'])) {
        header("Location: addEntry.php");
        exit();
    }
    else{
        header("Location: login.php");
    }
?>