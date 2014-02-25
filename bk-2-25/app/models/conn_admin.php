<?php
$dsn = 'mysql:host=localhost;dbname=scribesketch';
$username = 'php';
$password = 'php-pass';

try {
    $db = new PDO($dsn, $username, $password); // creates a PDO object
} catch (PDOException $exc) {
    echo 'Connection failed';
    exit;
}
?>