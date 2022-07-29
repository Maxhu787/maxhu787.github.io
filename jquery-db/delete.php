<?php
require_once "pdo.php";
require_once "head.php";
session_start();

$host = $_SERVER['HTTP_HOST'];
$ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$url = "http://$host$ruta";

if (!isset($_SESSION["user_id"])) {
    die("ACCESS DENIED");
}

if (isset($_POST["cancel"])) {
    header("Location: $url/index.php");
    die();
}

if (isset($_POST['delete']) && isset($_POST['profile_id'])) {
    $sql = "DELETE FROM profile WHERE profile_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['profile_id']));
    $_SESSION['success'] = 'Record deleted';
    header("Location: $url/index.php");
    die();
}

if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Missing profile_id";
    header("Location: $url/index.php");
    die();
}

$stmt = $pdo->prepare(
    "SELECT
    first_name,
    last_name
    FROM profile
    WHERE profile_id = :xyz"
);
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header("Location: $url/index.php");
    die();
}

$fn = htmlentities($row["first_name"]);
$ln = htmlentities($row["last_name"]);
?>
<!DOCTYPE html>
<html>

<head>
    <title>7e5c43ae</title>
</head>

<body>
    <h1>Deleting Profile</h1>
    <p>First Name: <?php echo $fn ?></p>
    <p>Last Name: <?php echo $ln ?></p>
    <form method="post">
        <input type="hidden" name="profile_id" value="<?php echo $_GET['profile_id'] ?>">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</body>

</html>