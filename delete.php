<?php
	session_start();

	$title = "Delete Animal";
	$subHeading = "Delete Animal";
	require('components/header.php');

	if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
		echo "<div class=\"alert alert-danger\">Access denied.<br><br>";
		echo "<a class=\"alert-link\"href=\"home.php\">Return to Dashboard</a></div>";
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

		$query = "DELETE FROM animal WHERE animalid = ?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i", $animalId);
		$stmt->execute();

		$affected_rows = $stmt->affected_rows;

		$stmt->close();
		$db->close();

		if ($affected_rows == 1) {
			echo "<div class=\"alert alert-success\">Successfully Deleted Animal<br>";
			echo "<a class=\"alert-link\" href=\"home.php\">Return to Dashboard</a>";
			exit;
		} 
		else {
			echo "<div class=\"alert alert-danger\">Failed to Delete Animal<br>";
			echo "<a class=\"alert-link\" href=\"home.php\">Return to Dashboard</a></div>";
			exit;
		}
	}
	else {

		if (!isset($animalId) || empty($animalId)) {
			echo "<div class=\"alert alert-danger\">Error: Animal ID not supplied</div";
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
		$adoptionFee = number_format($row['adoption_fee'],2);
		$sex = $row['sex'];

		// desexed
		if ($row['desexed'] == 1) {
			$desexed = "Yes";
		}
		else {
			$desexed = "No";
		}

		$deleteSwitch = true;
		require('forms/animal_form.php');
	}

	require('components/footer.php');
?>