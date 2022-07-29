<html>
<style>
    @import url('https://fonts.googleapis.com/css?family=Work+Sans:400,600');

    body {
        margin: 0;
        background: rgb(49, 49, 49);
        font-family: 'Work Sans', sans-serif;
        font-weight: 100;
        text-align: center;
        color: white;
    }

    a {
        color: orange;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 14px;
    }
    h1 {
        font-family: monospace;
    }
</style>

<head>
    <title>Guessing Game for g4o2</title>
</head>

<body>
    <h1>Welcome to my guessing game</h1>
    <p>
        <?php
        if (!isset($_GET['guess'])) {
            echo ("Missing guess parameter");
        } else if (strlen($_GET['guess']) < 1) {
            echo ("Your guess is too short");
        } else if (!is_numeric($_GET['guess'])) {
            echo ("Your guess is not a number");
        } else if ($_GET['guess'] < 42) {
            echo ("Your guess is too low");
        } else if ($_GET['guess'] > 42) {
            echo ("Your guess is too high");
        } else {
            echo ("Congratulations - You are right");
        }
        ?>
    </p>
    <a href="guessinggame.html">Try again</a>
</body>

</html>