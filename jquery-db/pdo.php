<?php
    $HOST = 'localhost';
    $PORT = 3306;
    $DB_NAME = 'misc';
    $DB_USER = 'g4o2';
    $DB_PASSWORD = 'g4o2';
    $pdo = new PDO(
        "mysql:host=$HOST;port=$PORT;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
