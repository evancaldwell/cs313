<?php
session_start();
// bring in the model and library
require $_SERVER['DOCUMENT_ROOT']."/models/general.php";
require $_SERVER['DOCUMENT_ROOT']."/library/library.php";

if (isset($_GET['action'])) { //**** need to change this to pull the hidden fields
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
    case 'submitSurvey':
        $newResult = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'major' => $_POST['major'],
            'app' => $_POST['app'],
            'comments' => $_POST['comments'],
        );

        $resultId = insertSurveyResult($newResult);
        $surveyResults = getSurveyResults();

        // include $_SERVER['DOCUMENT_ROOT'].'/views/assignments/class_survey_result.php';
        break;
    
    default:
        echo "there was a problem with the action";
        break;
}


?>