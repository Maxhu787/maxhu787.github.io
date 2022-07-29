<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['account'])) {
    die('Not logged in');
}

if (isset($_POST['cancel'])) {
    header("Location: view.php");
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
        require_once "pdo.php";
        $failure = false;
        if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
            if (is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) {
                $sql = "INSERT INTO autos (make, year, mileage) 
                    VALUES (:make, :year, :mileage)";
                //echo ("<pre>\n" . $sql . "\n</pre>\n");
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':make' => $_POST['make'],
                    ':year' => $_POST['year'],
                    ':mileage' => $_POST['mileage']
                ));
                $_SESSION['success'] = "Record inserted";
                header("Location: view.php");
                return;
            } else if (strlen($_POST['make'] < 1)) {
                $_SESSION['error'] = "Make is required";
                header("Location: add.php");
                return;
            } else {
                $_SESSION['error'] = "Mileage and year must be numeric";
                header("Location: add.php");
                return;
            }
        }
        ?>
        <?php
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <p>Make:
                <input type="text" name="make" size="60">
            </p>
            <p>Year:
                <input type="text" name="year">
            </p>
            <p>Mileage:
                <input type="text" name="mileage">
            </p>
            <p>
                <input type="submit" value="Add" />
                <input type="submit" name="cancel" value="Cancel">
            </p>
        </form>
</body>

</div>
</body>

</html>