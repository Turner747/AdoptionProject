
<?php 
	session_start();

	$title = "Login";
	$subHeading = "Login";
	require('components/header.php');

	if (isset($_POST['submit'])) {
		$submit = $_POST['submit'];

		if ($submit == "Cancel") {
			header('location: home.php');
			exit;
		}
	}

	if(isset($_POST['name']) || isset($_POST['password'])) {
		if (!isset($_POST['name']) || empty($_POST['name'])) {
			echo "<div class=\"alert alert-danger\">Name not supplied.<br>";
			echo "<br><a class=\"alert-link\" href=\"login.php\">Try Again</a></div>";
			$_SESSION["isLoggedIn"] = false;
			exit;
		}
		if (!isset($_POST['password']) || empty($_POST['password'])) {
			echo "<div class=\"alert alert-danger\">Password not supplied.<br>";
			echo "<br><a class=\"alert-link\" href=\"login.php\">Try Again</a></div>";
			$_SESSION["isLoggedIn"] = false;
			exit;
		}

		require('components/db_connection.php');
		$name = $_POST['name'];
		$password = $_POST['password'];

		$query = "SELECT count(*) FROM authorized_users WHERE username=? AND password= sha1(?)";
		
		$stmt = $db->prepare($query);
		$stmt->bind_param("ss", $name, $password);
		$stmt->execute();

		$result = $stmt->get_result();
		$stmt->close();

		if(!$result){
			echo "<div class=\"alert alert-danger\">Couldn't check credentials<br>";
			echo "<br><a class=\"alert-link\" href=\"login.php\">Try Again</a></div>";
			$db->close();
		}

		$row = $result->fetch_row();

		if($row[0] > 0) {
			$db->close();
			$_SESSION["isLoggedIn"] = true;
			$_SESSION["name"] = $name;
			header('location: home.php');
		}
		else {
			echo "<div class=\"alert alert-danger\">Username or Password is incorrect<br>";
			echo "<br><a class=\"alert-link\" href=\"login.php\">Try Again</a></div>";
			$db->close();
			$_SESSION["isLoggedIn"] = false;
		}
	}
	else {
		require('forms/login_form.php');
	}

	require('components/footer.php');
?>