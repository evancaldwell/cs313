<?php
session_start();
// bring in the model and library
require "../models/blocks.php";
require $_SERVER['DOCUMENT_ROOT']."/library/library.php";

if (isset($_GET['action'])) { //**** need to change this to pull the hidden fields
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
	case 'newBlock':
        $userId = $_SESSION['id'];
        $chapterId = $_POST['chapter'];
		$blockContent = $_POST['blockContent'];

		// check to make sure the user selected a chapter and entered text
		if(empty($chapterId) || empty($blockContent)) {
            $message = "All fields are required, please fix any missing information";
            // include $_SERVER['DOCUMENT_ROOT'].'/app/index.php';
            // exit;
        } else if (!empty($chapterId) && !empty($blockContent)) {
            $addBlockResult = addBlock($userId, $chapterId, $blockContent);
            if ($addBlockResult < 1) {
            	$message = "There was a problemm adding the block to database.";
            } else {
            	$message = "Added your block, keep writing!";
            	header('location:../index.php');
            }
        } else {
            $message = "There was an error with the data in the form";
        }

		break;
	
	case 'chapterBlocks':
		$userId = $_SESSION['id'];
        $chapterId = $_GET['chapterId'];

        $blocks = getBlocks($userId, $chapterId);

        include '../views/chapter_blocks.php';
		break;

	default:
		# code...
		break;
}

?>