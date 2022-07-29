<!DOCTYPE html>
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

    h1 {
        color: orange;
    }

    #submit {
        background-color: orange;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
    }

    #output {
        color: orange;
    }

    #submit:hover {
        background-color: grey;
        border-radius: 7px;
        -webkit-transition: background-color 1000ms linear;
        -ms-transition: background-color 1000ms linear;
        transition: background-color 1000ms linear;
    }

    a {
        margin-top: 100px;
        color: orange;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 30px;
        transition: color 0.2s ease-in-out;
    }

    a:hover {
        color: white;
    }
</style>

<head>
    <title>Cracking</title>
</head>

<body>
    <main class="content">
        <h1>MD5 cracker</h1>
        <pre>This application takes an MD5 hash of a four-character number string and attempts
   to hash all two-character combinations to determine the original two characters.</pre>
        <pre>
Debug Output:
<?php
$goodtext = "Not found";
if (isset($_GET['md5'])) {
    $time_pre = microtime(true);
    $md5 = $_GET['md5'];
    $txt = "1234567890";
    $show = 15;

    $count = 0;

    for ($i = 0; $i < strlen($txt); $i++) {
        $ch1 = $txt[$i];
        for ($j = 0; $j < strlen($txt); $j++) {
            $ch2 = $txt[$j];
            for ($k = 0; $k < strlen($txt); $k++) {
                $ch3 = $txt[$k];
                for ($l = 0; $l < strlen($txt); $l++) {
                    $ch4 = $txt[$l];
                    $try = $ch1 . $ch2 . $ch3 . $ch4;
                    $check = hash('md5', $try);
                    if ($check == $md5) {
                        $goodtext = $try;
                        break;
                    }
                    if ($show > 0) {
                        print "$check $try\n";
                        $show = $show - 1;
                    }
                    $count = $count + 1;
                }
            }
        }
    }
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post - $time_pre;
    print "\n";

    print "Total checks: ";
    print($count);
}
?>
</pre>
        <p id="output">PIN: <?= htmlentities($goodtext); ?></p>
        <form>
            <input type="text" name="md5" size="40" type="text" placeholder="Enter something" style="margin-right:10px;border-radius:10px;padding:10px;font-size:14px;background-color:rgb(49, 49, 49);color:orange;border:4px solid orange;}">
            <input id="submit" type="submit" value="Crack MD5">
        </form>
        <div style="color: lightblue; margin-top: 5px;">Example: 0bd65e799153554726820ca639514029</div>
    </main>
</body>
<footer>
    <br>
    <a id="link" href="../index.html">Go back to main page</a><br>
</footer>

</html>