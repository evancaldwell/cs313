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
        $password = hashPass($_POST['pass']);
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
            $warningMessage = "All fields are required, please fix any missing information";
            header('location:/app/index.php?warningMessage='.$warningMessage);
            exit;
        }
        
        //if no errors register the usr
        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
            $regResult = add_user($email, $password, $fname, $lname, $phone, $addr1, $addr2, $city, $state, $zip);
            if ($regResult < 1) {
            	$warningMessage = "There was a problemm adding info to database.";
                header('location:/app/index.php?warningMessage='.$warningMessage);
            } else {
                // login the user
                // $_SESSION['id'] = $userInfo['id'];
                // $_SESSION['fname'] = $userInfo['fname'];
                // $_SESSION['lname'] = $userInfo['lname'];
                // $_SESSION['email'] = $userInfo['email'];
                // $_SESSION['rights'] = $userInfo['rights'];
                // $_SESSION['password'] = $userInfo['password'];
                // $_SESSION['active'] = $userInfo['active'];
                // $_SESSION['loggedin'] = true;
                $userInfo = loginUser($email, $password);
                if(!empty($userInfo)){
                    // login the user
                    $_SESSION['id'] = $userInfo['id'];
                    $_SESSION['fname'] = $userInfo['f_name'];
                    $_SESSION['lname'] = $userInfo['l_name'];
                    $_SESSION['email'] = $userInfo['email'];
                    $_SESSION['rights'] = $userInfo['rights'];
                    $_SESSION['password'] = $userInfo['password'];
                    $_SESSION['active'] = $userInfo['active'];
                    $_SESSION['loggedin'] = true;
                    
                    if($userInfo['active'] == 1){
                        $successMessage = 'Thank you for registering!';
                        header('location: /app/home.php?successMessage='.$successMessage);
                        // include '/app/home.php';
                    } else {
                        $warningMessage = 'There was a problem with your registration';
                        header('location:/app/index.php?warningMessage='.$warningMessage);
                    }
                } else {
                    $warningMessage = "Sorry, there was a problem with your registration. Please try again";
                    header('location: /app/index.php?warningMessage='.$warningMessage);
                }
            }
        } else {
            $warningMessage = "There was an error with the data in the form";
        }

        include $_SERVER['DOCUMENT_ROOT'].'/app/home.php';
		break;

	case 'login': //TODO: somehow getting an error and landing on /controllers/default.php instead of /app/controllers/default.php
		// get the data
        $email = valEmail($_POST['email']);
        $password = hashPass($_POST['password']);
        
        if (empty($email) || empty($password)) {
            $warningMessage = 'Sorry, the email and/or password is incorrect. Please confirm and try again';
            header('location: /app/index.php?warningMessage='.$warningMessage);
            exit;
        }
        $userInfo = loginUser($email, $password);
        if(!empty($userInfo)){
            // login the user
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['fname'] = $userInfo['f_name'];
            $_SESSION['lname'] = $userInfo['l_name'];
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['rights'] = $userInfo['rights'];
            $_SESSION['password'] = $userInfo['password'];
            $_SESSION['active'] = $userInfo['active'];
            $_SESSION['loggedin'] = true;
            
            if($userInfo['active'] == 1){
                $successMessage = 'You have been logged in! ';
                header('location: /app/home.php?successMessage='.$successMessage);
                // include '/app/home.php';
            } else {
                $warningMessage = 'There was a problem logging you in';
                header('location:/app/index.php?warningMessage='.$warningMessage);
            }
        } else {
            $warningMessage = "Sorry, there was a problem with the login. Please try again";
            header('location: /app/index.php?warningMessage='.$warningMessage);
        }
		break;

        case 'logout':
            unset($_SESSION['id']);
            unset($_SESSION['fname']);
            unset($_SESSION['lname']);
            unset($_SESSION['email']);
            unset($_SESSION['rights']);
            unset($_SESSION['password']);
            unset($_SESSION['active']);
            unset($_SESSION['loggedin']);
            // header('location:/app/');
            $successMessage = 'You have been logged out.';
            include '../index.php';
        break;

	default:
		# code...
		break;
}

?>