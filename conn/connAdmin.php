<?php
	/*
	 *connection to the local test database
	 */
	 
	$dsn = 'mysql:localhost;dbname=test';
	$username = 'admin';
	$password = 'cs313';
	
	try {
	    $db = new PDO($dsn, $username, $password); // creates a PDO object
	} catch (PDOException $exc) {
	    echo 'Connection failed';
	    exit;
	}
?>