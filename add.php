<?php
	session_start();

	$title = "Add Animal";
	$subHeading = "Add Animal";
	require('components/header.php');


	if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
		echo "<div class=\"alert alert-danger\">Access denied.<br><br>";
		echo "<a class=\"alert-link\" href=\"home.php\">Return to Dashboard</a></div";
		exit;
	}

	require('components/db_connection.php');

	if (isset($_POST['submit'])) {
		$submit = $_POST['submit'];

		if ($submit == "Cancel") {
			header('location: home.php');
			exit;
		}

		require('components/validate_animal_input.php');

		$name = $_POST['name'];
		$animalType = $_POST['animal-type'];
		$adoptionFee = $_POST['adoption-fee'];
		$sex = $_POST['sex'];
		$desexed = $_POST['desexed'];

		$query = "INSERT INTO animal (name, animal_type, adoption_fee, sex, desexed) VALUES (?,?,?,?,?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ssisi", $name, $animalType, $adoptionFee, $sex, $desexed);
		$stmt->execute();

		$affected_rows = $stmt->affected_rows;

		$stmt->close();
		$db->close();

		if ($affected_rows == 1) {
			echo "<div class=\"alert alert-success\">Successfully Added Animal<br>";
			echo "<a class=\"alert-link\" href=\"home.php\">Return to Dashboard</a></div>";
			exit;
		} 
		else {
			echo "<div class=\"alert alert-danger\">Failed to Add Animal<br>";
			echo "<a class=\"alert-link\"href=\"home.php\">Return to Dashboard</a></div>";
			exit;
		}
	}
	else {
		require('forms/animal_form.php');
	}

	require('components/footer.php');
?>