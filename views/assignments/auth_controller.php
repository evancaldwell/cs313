<?php

$mysqli = new mysqli("localhost", "php", "php-pass", "cs313");
if ($mysqli->connect_errno) {
    echo "Failed to connect to mysql: ".$mysqli->connect_errno;
}

session_start();
require $_SERVER['DOCUMENT_ROOT']."/library/library.php";

// ============ Model stuff ================================
function addUser($username, $password, $mysqli) {
    $mysqli->query("INSERT INTO users (user_name, password) VALUES (\"$username\", \"$password\")");
    return $mysqli->insert_id;
}

function loginUser($username, $password, $mysqli) {
    $result = $mysqli->query("SELECT user_id, user_name, password FROM users WHERE username=\"$username\"");
    return $result;
}

// ==========================================================

if (isset($_GET['action'])) { //**** need to change this to pull the hidden fields
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
	case 'signup':
		$username = valEmail($_POST['username']);
        $password = hashPass($_POST['pass1']);
        echo 'hit the signup case after ';
        
        if(empty($username) || empty($password)) {
            $warningMessage = "All fields are required, please fix any missing information";
            header('location: auth_signup.php?message=$warningMessage');
        }
        
        //if no errors register the usr
        if (!empty($username) && !empty($password)) {
            // call the function to insert into the db
            $regResult = addUser($username, $password, $mysqli);

            if ($regResult < 1) {
            	$message = "There was a problemm adding info to database. ".$username." | ".$password;
            } else {
            	$message = "Thank You for Registering!"; //**** this should actually be another view with either a timed redirection or suggestions of next steps
                // login the user
                $_SESSION['id'] = $regResult;
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = true;
            }
        } else {
            $message = "There was an error with the data in the form";
        }

        header("location: auth_home.php?message=".$message."&username=".$username);
		break;

	case 'login': //TODO: somehow getting an error and landing on /controllers/default.php instead of /app/controllers/default.php
		// get the data
        $username = valEmail($_POST['username']);
        $password = hashPass($_POST['password']);
        
        if (empty($username) || empty($password)) {
            $message = 'Sorry, the username and/or password is incorrect. Please confirm and try again';
            exit;
        }
        $usrInfo = loginUser($username, $password, $mysqli);
        if(!empty($usrInfo)){
            // login the user
            // $_SESSION['id'] = $usrInfo[0]['id'];
            // $_SESSION['username'] = $usrInfo[0]['username'];
            // $_SESSION['password'] = $usrInfo[0]['password'];
            // $_SESSION['loggedin'] = true;
            
            if($_SESSION['id'] > 0){
                // direct the user back to the main page
                // header('location:/app/index.php');
                $message = 'You have been logged in! ';
                header("location: auth_home.php?message=".$message);
            } else {
                $message = 'There was a problem logging you in';
                header("location: auth_home.php?message=".$message);
            }
        } else {
            $message = "Sorry, there was a problem with the login. Please try again";
            //include 'view.php';
        }
		break;

        case 'logout':
            unset($_SESSION['id']);
            unset($_SESSION['fname']);
            unset($_SESSION['lname']);
            unset($_SESSION['username']);
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