<?php
$dsn = 'mysql:localhost;dbname=scribesketch';
$username = 'php';
$password = 'php-pass';

try {
    $db = new PDO($dsn, $username, $password); // creates a PDO object
    echo "connection successful!<br>";
} catch (PDOException $exc) {
    echo 'Connection failed';
    exit;
}
?>