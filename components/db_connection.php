<?php
    $dbAddress = 'mysql';
    $dbUser = 'webauth';
    $dbPass = 'webauth';
    $dbName = 'adoption';

    $db = new mysqli($dbAddress, $dbUser, $dbPass, $dbName);
    if ($db->connect_error) {
        echo "Could not connect to the database.  Please try again later.";
        exit;
    }
?>