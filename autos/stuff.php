<?php
require_once "pdo.php";

if (
    isset($_POST['make']) && isset($_POST['year'])
    && isset($_POST['mileage'])
) {
    $sql = "INSERT INTO autos (make, year, mileage) 
              VALUES (:make, :year, :mileage)";
    echo ("<pre>\n" . $sql . "\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage']
    ));
}

if (isset($_POST['delete']) && isset($_POST['auto_id'])) {
    $sql = "DELETE FROM autos WHERE auto_id = :zip";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['auto_id']));
}

$stmt = $pdo->query("SELECT make, year, mileage, auto_id FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>

<head></head>

<body>
    <table border="1">
        <?php
        foreach ($rows as $row) {
            echo "<tr><td>";
            echo ($row['make']);
            echo ("</td><td>");
            echo ($row['year']);
            echo ("</td><td>");
            echo ($row['mileage']);
            echo ("</td><td>");
            echo ('<form method="post"><input type="hidden" ');
            echo ('name="auto_id" value="' . $row['auto_id'] . '">' . "\n");
            echo ('<input type="submit" value="Del" name="delete">');
            echo ("\n</form>\n");
            echo ("</td></tr>\n");
        }
        ?>
    </table>
    <p>Add A New User</p>
    <form method="post">
        <p>Make:
            <input type="text" name="make" size="40">
        </p>
        <p>Year:
            <input type="text" name="year">
        </p>
        <p>Mileage:
            <input type="text" name="mileage">
        </p>
        <p><input type="submit" value="Add New" /></p>
    </form>
</body>