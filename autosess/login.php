<?php // Do not put any HTML above this line
session_start();
if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $who = htmlentities($_POST['email']);
    $pass = htmlentities($_POST['pass']);
    $_SESSION['account'] = $who;
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "Email and password are required";
        header("Location: login.php");
        return;
    } else if (!preg_match("/@/", $_POST['email'])) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else {
        if ($_POST['pass'] == "umsi") {
            $_SESSION["success"] = "Logged in.";
            header("Location: view.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            header("Location: login.php");
            return;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>80c817df</title>
</head>

<body>
    <div class="container">
        <h1>Please Log In</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST">
            <label for="nam">Email</label>
            <input type="text" name="email" id="nam"><br />
            <label for="id_1723">Password</label>
            <input type="pass" name="pass" id="id_1723"><br />
            <input type="submit" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</body>