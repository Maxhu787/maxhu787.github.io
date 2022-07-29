<!DOCTYPE html>
<html>

<head>
    <title>g4o2</title>
    <?php require_once "bootstrap.php"; ?>
    <style>
        body {
            background: url(../media/0000001.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            color: white;
        }

        a {
            color: orange;
        }

        a:hover {
            color: lightgray;
        }

        .container {
            margin-right: 40px;
        }

        ::-moz-selection {
            color: orange;
            /*background: black;*/
        }

        ::selection {
            color: orange;
            /*background: black;*/
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Rock Paper Scissors</h1>
        <p>
            <a href="login.php">Please Log In</a>
        </p>
        <p>
            Attempt to go to
            <a href="game.php">game.php</a> without logging in - it should fail with an error message.
            <!--<p>
            <a href="http://www.wa4e.com/code/rps.zip" target="_blank">Source Code for this Application</a>
        </p>-->
        <p>
            Go back to <a href="../index.html">main</a> page
        </p>
    </div>
</body>