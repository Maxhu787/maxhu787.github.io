<?php
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die('Name parameter missing');
}

if (isset($_POST['logout'])) {
    header('Location: index.php');
    return;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>6f1a4abb</title>
    <?php require_once "bootstrap.php"; ?>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_REQUEST['name'])) {
            echo '<h1>Tracking Autos for ';
            echo htmlentities($_REQUEST['name']);
            echo "</h1>\n";
        }
        ?>
        <?php
            require_once "pdo.php";
            $failure = false;
            if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
                if(is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) {
                    $sql = "INSERT INTO autos (make, year, mileage) 
                    VALUES (:make, :year, :mileage)";
                    //echo ("<pre>\n" . $sql . "\n</pre>\n");
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':make' => $_POST['make'],
                        ':year' => $_POST['year'],
                        ':mileage' => $_POST['mileage']
                    )); 
                } else if(strlen($_POST['make'] < 1)) {
                    $failure = "Make is required";
                } else {
                    $failure = "Mileage and year must be numeric";
                }
            } 

            if (isset($_POST['delete']) && isset($_POST['auto_id'])) {
                $sql = "DELETE FROM autos WHERE auto_id = :zip";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(':zip' => $_POST['auto_id']));
            }

            $stmt = $pdo->query("SELECT make, year, mileage, auto_id FROM autos");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php
        if ($failure !== false) {
            echo ('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
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
            <p><input type="submit" value="Add" />
                <input type="submit" name="logout" value="Logout">
            </p>
        </form>
        <h2>Automobiles</h2>
        <ul>
            <?php
            foreach ($rows as $row) {
                echo ("<li>");
                echo ($row['make']);
                echo "\n";
                echo ($row['year']);
                echo " / ";
                echo ($row['mileage']);
                echo "\n";
                echo ("</li>");
            }
            ?>
        </ul>
</body>

</div>
</body>

</html>