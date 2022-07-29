<?php
require_once "head.php";
require_once "pdo.php";
session_start();
$stmt = $pdo->query(
    "SELECT profile_id, first_name, last_name, headline
    FROM profile"
);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>7e5c43ae</title>
</head>

<body>
    <h1>
        Max's Resume Registry
    </h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
        unset($_SESSION['success']);
    }

    if (!isset($_SESSION["user_id"])) {
        echo "<a href='login.php'>Please log in</a>";
    } else {
        echo "<a href='logout.php'>Logout</a>";
    }

    if (count($rows) > 0) {
        echo '<table border="1">' . "\n";
        echo "<tr><td>";
        echo "Name";
        echo "</td><td>";
        echo "Headline";
        echo "</td>";
        if (isset($_SESSION["user_id"])) {
            echo "<td>Action</td>";
        }
        echo "</tr>\n";
        foreach ($rows as $row) {
            echo "<tr><td>";
            echo
            "<a href='view.php?profile_id=" .
                $row["profile_id"] . "'>" .
                htmlentities($row['first_name'] . " " . $row['last_name']) . "</a>";
            echo ("</td><td>");
            echo (htmlentities($row['headline']));
            echo ("</td>");
            if (isset($_SESSION["user_id"])) {
                echo
                '<td><a href="edit.php?profile_id=' .
                    $row['profile_id'] . '">Edit</a> ';
                echo
                '<a href="delete.php?profile_id=' .
                    $row['profile_id'] . '">Delete</a></td>';
            }
            echo ("</tr>\n");
        }
        echo "</table>";
    }
    if (isset($_SESSION["user_id"])) {
        echo '<p><a href="add.php">Add New Entry</a></p>';
    }
    ?>
</body>

</html>