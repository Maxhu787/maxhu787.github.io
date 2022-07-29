<?php
require_once "pdo.php";
session_start();

// Check if we are logged in!
if (!isset($_SESSION['email'])) {
	die('ACCESS DENIED');
}

// If the user requested logout go back to index.php
if (isset($_POST['logout'])) {
	header('Location: index.php');
	return;
}


//$make = htmlentities($_POST['make']);
//$year = htmlentities($_POST['year']);
//$mileage = htmlentities($_POST['mileage']);

if (isset($_POST['add'])) {
	unset($_SESSION['make']);
	unset($_SESSION['year']);
	unset($_SESSION['mileage']);

	$make = htmlentities($_POST['make']);
	$year = htmlentities($_POST['year']);
	$mileage = htmlentities($_POST['mileage']);
	$model = htmlentities($_POST['model']);
	if (strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1) {
		$_SESSION['failure'] = 'All fields are required';
		header("Location: add.php");
		return;
	}
	if (strlen($make) < 1) {
		$_SESSION['failure']  = "Make is required";
		header('Location: add.php');
		return;
	} elseif (!is_numeric($year) || (!is_numeric($mileage)) || strlen($year) < 1 || strlen($mileage) < 1) {
		$_SESSION['failure'] = "Mileage and year must be numeric";
		header('Location: add.php');
		return;
	} elseif (strlen($model) < 1) {
		$_SESSION['failure']  = "All fields are required";
		header('Location: add.php');
		return;
	} else {

		$_SESSION['make'] = $make;
		$_SESSION['model'] = $model;
		$_SESSION['year'] = $year;
		$_SESSION['mileage'] = $mileage;

		$stmt = $pdo->prepare('INSERT INTO autos
        (make, model, year, mileage) VALUES ( :mk, :ml, :yr, :mi)');
		$stmt->execute(
			array(
				':mk' => $make,
				':ml' => $model,
				':yr' => $year,
				':mi' => $mileage
			)
		);
		$_SESSION['success'] = "Record added.";
		header('Location:index.php');
		return;
	}
}



?>


<!DOCTYPE html>
<html>

<head>
	<title>42fde095</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>

<body>
	<div class="container">
		<h1>Tracking Automobiles for <?= htmlentities($_SESSION['email']); ?></h1>

		<?php
		if (isset($_SESSION['failure'])) {
			echo ('<p style="color:red">' . htmlentities($_SESSION['failure']) . "</p>\n");
			unset($_SESSION['failure']);
		}
		?>

		<form method="post">
			<p>Make:
				<input type="text" name="make" size="60" />
			</p>
			<p>Model:
				<input type="text" name="model" size="60" />
			</p>
			<p>Year:
				<input type="text" name="year" />
			</p>
			<p>Mileage:
				<input type="text" name="mileage" />
			</p>
			<input type="submit" name="add" value="Add">
			<input type="submit" name="logout" value="Logout">
		</form>


	</div>
	<script data-cfasync="false" src="/cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script>
</body>

</html>