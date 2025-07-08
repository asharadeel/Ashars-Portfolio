<?php
    date_default_timezone_set("UTC");
    session_start();

    $fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : null;
    $lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : null;
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

    // Output session data as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email
    ]);
?>