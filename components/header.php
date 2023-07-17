<?php
	if ((isset($_SESSION["isLoggedIn"]) || !empty($_SESSION["isLoggedIn"]))
		&& (isset($_SESSION["name"]) || !empty($_SESSION["name"]))) {
		$isLoggedIn = $_SESSION["isLoggedIn"];
		$name = $_SESSION["name"];
	}
	else {
		$isLoggedIn = false;
		$_SESSION["isLoggedIn"] = false;
	}
?>
<html>
	<head>
		<title><?php echo isset($title) ? $title." - " : ""; ?>Adoption Management System</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	</head>
	<body>
		<nav class="navbar bg-dark sticky-top mb-4">
			<div class="container-fluid">
				<h2 class="navbar-brand ms-2 text-light my-auto"><?php echo isset($heading) ? $heading : "Adoption Management System"; ?></h2>
				<?php echo (isset($isLoggedIn) &&  $isLoggedIn) 
						? "<div class=\"badge rounded-pill text-bg-primary d-flex justify-content-end\"><i class=\"bi bi-person-circle fs-4\"></i><div class=\"ms-3 me-2 fs-6 my-auto\">$name</div></div>" 
						: ""; ?>
			</div>
		</nav>

		<div class="container px-5">
			<h2 class="mb-3"><?php echo isset($subHeading) ? $subHeading : ""; ?></h2>