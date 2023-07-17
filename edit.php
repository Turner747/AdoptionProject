<?php
	session_start();

	$title = "Edit Animal";
	$subHeading = "Edit Animal";
	require('components/header.php');

	if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
		echo "<div class=\"alert alert-danger\">Access denied.<br><br>";
		echo "<a class=\"alert-link\" href=\"home.php\">Return to Dashboard</a></div>";
		exit;
	}

	require('components/db_connection.php');

	if (!isset($_GET['animalid']) || empty($_GET['animalid'])) {
		echo "<div class=\"alert alert-danger\">Error: Animal ID not supplied</div>";
		exit;
	}

	$animalId = $_GET['animalid'];

	if (isset($_POST['submit'])) {
		$submit = $_POST['submit'];

		if ($submit == "Cancel") {
			header('location: /home.php');
			exit;
		}

		require('components/validate_animal_input.php');

		$animalName = $_POST['animal-name'];
		$animalType = $_POST['animal-type'];
		$adoptionFee = $_POST['adoption-fee'];
		$sex = $_POST['sex'];
		$desexed = $_POST['desexed'];

		$query = "UPDATE animal
					SET name=?, animal_type=?, adoption_fee=?, sex=?, desexed=?
					WHERE animalid=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ssisii", $animalName, $animalType, $adoptionFee, $sex, $desexed, $animalId);
		$stmt->execute();

		$affected_rows = $stmt->affected_rows;

		$stmt->close();
		$db->close();

		if ($affected_rows == 1) {
			echo "<div class=\"alert alert-success\">Successfully Updated Animal<br>";
			echo "<a class=\"alert-link\" href=\"home.php\">Return to Dashboard</a></div>";
			exit;
		} 
		else {
			echo "<div class=\"alert alert-danger\">Failed to Update Animal<br>";
			echo "<a class=\"alert-link\"href=\"home.php\">Return to Dashboard</a></div>";
			exit;
		}
	}
	else {
		if (!isset($animalId) || empty($animalId)) {
			echo "<div class=\"alert alert-danger\">Error: Animal ID not supplied</div>";
			exit;
		}

		$queryAnimalDetails = "SELECT * FROM animal WHERE animalid = ?";
		$stmtAnimalDetails = $db->prepare($queryAnimalDetails);
		$stmtAnimalDetails->bind_param("i", $animalId);

		$stmtAnimalDetails->execute();
		$result = $stmtAnimalDetails->get_result();
		$stmtAnimalDetails->close();

		$row = $result->fetch_assoc();

		$animalName = $row['name'];
		$animalType = $row['animal_type'];
		$adoptionFee = $row['adoption_fee'];
		$sex = $row['sex'];
		$desexed = $row['desexed'];

		require('forms/animal_form.php');
	}

	require('components/footer.php');
?>
