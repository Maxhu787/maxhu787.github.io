<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['account'])) {
    die('Not logged in');
}

if (isset($_POST['logout'])) {
    header('Location: index.php');
    return;
}

$stmt = $pdo->query("SELECT make, year, mileage, auto_id FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <title>80c817df</title>
    <?php require_once "bootstrap.php"; ?>
</head>

<body>
    <div class="container">
        <h1>Tracking Autos for <?= htmlentities($_SESSION['account']); ?></h1>
        <?php
        if (isset($_SESSION["success"])) {
            echo ('<p style="color:green">' . htmlentities($_SESSION["success"]) . "</p>\n");
            unset($_SESSION["success"]);
        }
        ?>
        <h2>Automobiles</h2>
        <?php
        foreach ($rows as $row) {
            echo "<ul><li>";
            echo htmlentities($row['year']);
            echo " ";
            echo htmlentities($row['make']);
            echo " ";
            echo "/";
            echo " ";
            echo htmlentities($row['mileage']);
            echo "</li></ul>\n";
        }
        ?>
        <a href="add.php">Add New</a>
        <a href="logout.php">Logout</a>
    </div>
</body>

</div>
</body>

</html>