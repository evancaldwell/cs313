<?php
// **** could put requires for session start and models here

/*Custom Functions Library*/

function valString($string) {
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    
    return $string;
}

function valEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $email;
}

function hashPass($password) {
    $password = crypt($_POST['password'], '$2a$07$saltmakemyhamburgeryum');
    return $password;
}

// function valImageUpload($_FILES, $key) {
//     $allowedExts = array("gif", "jpeg", "jpg", "png");
//     $temp = explode(".", $_FILES[$key]["name"]);
//     $extension = end($temp);
//     if ((($_FILES[$key]["type"] == "image/gif")
//     || ($_FILES[$key]["type"] == "image/jpeg")
//     || ($_FILES[$key]["type"] == "image/jpg")
//     || ($_FILES[$key]["type"] == "image/JPG")
//     || ($_FILES[$key]["type"] == "image/pjpeg")
//     || ($_FILES[$key]["type"] == "image/x-png")
//     || ($_FILES[$key]["type"] == "image/png"))
//     && ($_FILES[$key]["size"] < 200000) //**** need to decide what a reasonable size is
//     && in_array($extension, $allowedExts)) {
//         return true;
//     } else {
//         return false;
//     }
// }

// function fileUpload($_FILES, $key, $path) {
//     if (file_exists($path . $_FILES[$key]["name"])) {
//         return false;
//     }
//     else {
//         move_uploaded_file($_FILES[$key]["tmp_name"], $path . $_FILES[$key]["name"]);
//         //echo "Stored in: " . $path . $_FILES[$key]["name"];
//         return true;
//     }
// }

function buildJournalEntry($entryTitle, $entryTime, $entryBody, $lastId) { //**** need to convert /n/n and /n/r to <br> so I don't have to add it into the body
    $id = $lastId+1;
    $date = date('F d, Y');
    
    $entry = '<div id="entry'.$id.'" class="full-width top-entry">
        <h3>'.$entryTitle.'</h3>
        <p class="subtitle">Entry #'.$id.' - '.$date.'</p>
		<p class="support-info">Time Spent: '.$entryTime.' hrs</p><br>
        <p>'.$entryBody.'</p>
    </div>';
    return $entry;
}

function getSnippet($snippetName) {
    // pull in the database from the controller
    global $db;
    
    try {
        $sql = 'SELECT snippet FROM codeSnippets WHERE snippet_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $snippetName);
        $stmt->execute();
        $snippet = $stmt->fetch();
        $stmt->closeCursor();
        return $snippet;
    } catch(PDOException $e) {
        return 0;
    }
}
?>