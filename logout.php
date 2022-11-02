<?php
	session_start();
    session_unset();
    $isLoggedOut = session_destroy();

	$title = "Logged Out";
	require('components/header.php');

    echo $isLoggedOut 
        ? "<div class=\"alert alert-success\">Logged Out</div>" 
        : "<div class=\"alert alert-danger\">Error occurred when trying to log out</div>";

    require('components/footer.php');
?>
