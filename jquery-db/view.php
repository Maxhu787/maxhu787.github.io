<?php
require_once "pdo.php";
require_once "head.php";
session_start();

if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Missing profile_id";
    header("Location: $url/index.php");
    die();
}

$sql = "SELECT * FROM profile WHERE profile_id = :profile_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":profile_id" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header('Location: index.php');
    die();
}

$fn = htmlentities($row["first_name"]);
$ln = htmlentities($row["last_name"]);
$em = htmlentities($row["email"]);
$he = htmlentities($row["headline"]);
$su = htmlentities($row["summary"]);

$sql = "SELECT * FROM position WHERE profile_id = :profile_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":profile_id" => $_GET['profile_id']));
$position_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM education WHERE profile_id = :profile_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":profile_id" => $_GET['profile_id']));
$education_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>7e5c43ae</title>
</head>

<body>
    <h1>Profile information</h1>
    <p>First Name: <?php echo $fn ?></p>
    <p>Last Name: <?php echo $ln ?></p>
    <p>Email: <?php echo $em ?></p>
    <p>
        Headline:
        <br>
        <?php echo $he ?>
    </p>
    <p>
        Summary:
        <br>
        <?php echo $su ?>
    </p>
    <?php
    if ($education_rows !== false) {
        echo '<p>Education' . "\n" . '<ul>' . "\n";
    }
    foreach ($education_rows as $row) {
        $stmt = $pdo->prepare(
            "SELECT name
            FROM institution
            WHERE institution_id = :instid"
        );
        $stmt->execute(array(":instid" => $row['institution_id']));
        echo
        '<li>' . $row["year"] . ': ' .
            $stmt->fetch(PDO::FETCH_ASSOC)["name"] . '</li>' . "\n";
    }
    echo '</ul>' . "\n" . '</p>';

    if ($position_rows !== false) {
        echo '<p>Position' . "\n" . '<ul>' . "\n";
    }
    foreach ($position_rows as $row) {
        echo '<li>' . $row["year"] . ': ' . $row["description"] . '</li>' . "\n";
    }
    echo '</ul>' . "\n" . '</p>';
    ?>
    <a href="index.php">Done</a>
</body>

</html>