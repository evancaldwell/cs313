<?php
session_start();
// bring in the model and library
require "../models/users.php";
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

	case 'login': //TODO: somehow getting an error and landing on /controllers/default.php instead of /app/controllers/default.php
		// get the data
        $email = valEmail($_POST['email']);
        $password = hashPass($_POST['password']);
        
        if (empty($email) || empty($password)){
            $message = 'Sorry, the email and/or password is incorrect. Please confirm and try again';
            exit;
        }
        $usrInfo = loginUser($email, $password);
        if(!empty($usrInfo)){
            // login the user
            $_SESSION['id'] = $usrInfo[0]['id'];
            $_SESSION['fname'] = $usrInfo[0]['fname'];
            $_SESSION['lname'] = $usrInfo[0]['lname'];
            $_SESSION['email'] = $usrInfo[0]['email'];
            $_SESSION['rights'] = $usrInfo[0]['rights'];
            $_SESSION['password'] = $usrInfo[0]['password'];
            $_SESSION['active'] = $usrInfo[0]['active'];
            $_SESSION['loggedin'] = true;
            
            if($usrInfo[0]['rights'] == 3 && $usrInfo[0]['active'] == 1){
                // Could be sent to admin view
                header('location:/admin');
            } else {
                //include 'view.php'; //**** actually need to send them to some other view - like product browsing
                // header('location:/app/index.php');
            }
        } else {
            $message = "Sorry, there was a problem with the login. Please try again";
            //include 'view.php';
        }
		break;
	
	default:
		# code...
		break;
}

?>