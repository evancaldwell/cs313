<?php
session_start();
// bring in the model and library
require $_SERVER['DOCUMENT_ROOT']."/app/models/users.php";
require $_SERVER['DOCUMENT_ROOT']."/library/library.php";

if (isset($_GET['action'])) { //**** need to change this to pull the hidden fields
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
	case 'register':
		$email = valEmail($_POST['email']);
        $password = hashPass($_POST['pass1']);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $addr1 = $_POST['addr1'];
        $addr2 = $_POST['addr2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        
        //clean, validate and notify of problems
        $errors = array();
        if(empty($fname) || empty($lname) || empty($email) || empty($password)) {
            $message = "All fields are required, please fix any missing information";
            include $_SERVER['DOCUMENT_ROOT'].'/app/index.php';
            exit;
        }
        
        //if no errors register the usr
        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
            $regResult = add_user($email, $password, $fname, $lname, $phone, $addr1, $addr2, $city, $state, $zip);
            echo $regResult."<br>";
            if ($regResult < 1) {
            	$message = "There was a problemm adding info to database.";
            } else {
            	$message = "Thank You for Registering!"; //**** this should actually be another view with either a timed redirection or suggestions of next steps
            }
        } else {
            $message = "There was an error with the data in the form";
        }

        include $_SERVER['DOCUMENT_ROOT'].'/app/index.php';
		break;
	case 'login':
		# code...
		break;
	
	default:
		# code...
		break;
}

?>