<?php
	/*
	 *connection to the local test database
	 */
	 
	// $mysqli = new mysqli("localhost", "php", "php-pass", "scribesketch");
	// if ($mysqli->connect_errno) {
	// 	echo "Failed to connect to mysql: ".$mysqli->connect_errno;
	// } else {
	// 	echo "Connection Successful!";
	// }

	// $results = $mysqli->query("SELECT * FROM auth");
	// var_dump($results);
	// echo "name: ". $results[0];
	// while ($row = $results­>fetch_assoc()) {
	// 	echo "name: ".$row["username"]."<br>";
	// }

	// previous way
	$dsn = 'mysql:localhost;dbname=scribesketch';
	$username = 'php';
	$password = 'php-pass';
	
	try {
	    $db = new PDO($dsn, $username, $password); // creates a PDO object
	} catch (PDOException $exc) {
	    echo 'Connection failed';
	    exit;
	}
?>