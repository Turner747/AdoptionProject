<?php session_start();

	if ((isset($_SESSION["isLoggedIn"]) || !empty($_SESSION["isLoggedIn"]))
		&& (isset($_SESSION["name"]) || !empty($_SESSION["name"]))) {
		$isLoggedIn = $_SESSION["isLoggedIn"];
		$name = $_SESSION["name"];
	}
	else {
		$isLoggedIn = false;
		$_SESSION["isLoggedIn"] = false;
	}
	
	
	$heading = "Adoption Management Dashboard";
	require('components/header.php');

	if ($isLoggedIn) {
		
		echo "<div class=\"alert alert-primary mb-4 w-25 me-2 d-inline-block\">Welcome, $name</div>";
	}

	require('components/animal_table.php');
	require('components/footer.php');

?>