<p>HTML field types...</p>
<form method="$_POST" action="html5.php">
    Select your favorite color: <input type="color" name="favcolor" value="#ffc200"><br>
    Birthday: <input type="date" name="bday" value="2008-02-07"><br>
    E-mail: <input type="email" name="email"><br>
    Quantity (between 1 and 10): <input type="number" min="1" max="10"><br>
    Add your homepage: <input type="url" name="homepage"><br>
    Transportation: <input type="flying" name="saucer"><br>
    <input type="submit" name="dopost" value="Submit" />
    <input type="button" onclick="location.href='http://www.wa4e.com/'; return false;" value="Escape">
</form>
<pre>
$_POST:
<?php
    print_r($_POST);
?>
</pre>