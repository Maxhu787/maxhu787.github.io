<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'g4o2', 'g4o2');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
