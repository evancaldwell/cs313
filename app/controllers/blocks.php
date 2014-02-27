<?php
session_start();
// bring in the model and library
require "../models/blocks.php";
require "../../library/library.php";

if (isset($_GET['action'])) { //**** need to change this to pull the hidden fields
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
}


$userId = $_SESSION['id'];
if (isset($_SESSION['projectId'])) {
    $projectId = $_SESSION['projectId'];
} else {
    echo 'projectId not set';
}

switch ($action) {
	case 'newProject':
		$title = $_POST['projectTitle'];
		$description = $_POST['projectDesc'];

		if(empty($title) || empty($description)) {
            $message = "All fields are required, please fix any missing information";
            // include 'index.php';
            // exit;
        } else if (!empty($title) || !empty($description)) {
            $newProjId = addProject($userId, $title, $description);
            if ($newProjId < 1) {
            	$message = "There was a problemm adding the chapter to database.";
            } else {
                $_SESSION['projectId'] = $newProjId;
            	$message = "Added your chapter, keep writing!";
            	header('location:../index.php');
            }
        } else {
            $message = "There was an error with the data in the form";
        }

		break;

	case 'newChapter':
		// $projectId = 1; //TODO: this needs to be pulled dynamically
		$chapterNum = $_POST['chapterNum'];
		$chapterName = $_POST['chapterName'];

		if(empty($chapterNum) || empty($chapterName)) {
            $message = "All fields are required, please fix any missing information";
            // include 'index.php';
            // exit;
        } else if (!empty($chapterNum) || !empty($chapterName)) {
            $newChapId = addChapter($chapterNum, $chapterName, $_SESSION['projectId']);
            if ($newChapId < 1) {
            	$message = "There was a problemm adding the chapter to database.";
            } else {
            	$message = "Added your chapter, keep writing!";

                $data = array(
                "projectId"=>$projectId,
                "chapterNum"=>$chapterNum,
                "chapterName"=>$chapterName,
                "message"=>$message
                );
            	// header('location:../index.php');
            }
        } else {
            $message = "There was an error with the data in the form";
        }

		break;

	case 'newBlock':
        $chapterId = $_POST['chapter'];
		$blockContent = $_POST['blockContent'];

		// check to make sure the user selected a chapter and entered text
		if(empty($chapterId) || empty($blockContent)) {
            $message = "All fields are required, please fix any missing information";
            // include 'index.php';
            // exit;
        } else if (!empty($chapterId) && !empty($blockContent)) {
            $addBlockResult = addBlock($userId, $chapterId, $blockContent);
            if ($addBlockResult < 1) {
            	$message = "There was a problem adding the block to database.";
            } else {
            	$message = "Added your block, keep writing!";
                $data = [
                "projectId"=>$projectId,
                "chapterId"=>$chapterId,
                "blockContent"=>$blockContent,
                "message"=>$message
                ];

                return $data;
            	// header('location:../index.php');
            }
        } else {
            $message = "There was an error with the data in the form";
        }

		break;

    case 'newCharacter':
        $projectId = $_SESSION['projectId']; //TODO: this needs to be pulled dynamically
        $characterName = $_POST['characterName'];
        $characterDesc = $_POST['characterDesc'];

        if(empty($characterName) || empty($characterDesc)) {
            $message = "All fields are required, please fix any missing information";
            // include 'index.php';
            // exit;
        } else if (!empty($characterName) || !empty($characterDesc)) {
            $newChartrId = addCharacter($characterName, $characterDesc, $_SESSION['projectId']);
            if ($newChartrId < 1) {
                $message = "There was a problemm adding the chapter to database.";
            } else {
                $message = "Added your new character, keep writing!";
                // return data to the js funcion and then use the function to call the php file again
                $data = [
                "projectId"=>$projectId,
                "characterName"=>$characterName,
                "characterDesc"=>$characterDesc,
                "message"=>$message
                ];
                // echo json_encode($data);
                // exit;
                return json_encode($data);
                // header('location:../index.php');
            }
        } else {
            $message = "There was an error with the data in the form";
        }

        break;
	
	case 'chapterBlocks':
        $chapterId = $_GET['chapterId'];
        $blocks = getBlocks($userId, $chapterId);

        if (!$blocks) {
            $infoMessage = 'There were no blocks added to this chapter.';
        }

        include '../views/chapter_blocks.php';
        // header('location: ../views/chapter_blocks.php?chapterId='.$chapterId.'&blocks='.$blocks);
		break;

	default:
		header('locaion: ../index.php');
		break;
}

?>