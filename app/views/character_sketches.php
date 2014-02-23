<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require '../models/blocks.php';

if (isset($_GET['projectId'])) {
	$projectId = $_GET['projectId'];
	echo 'GET projectId: '.$projectId;
} elseif (isset($_POST['projectId'])) {
	$projectId = $_POST['projectId'];
	echo 'POST projectId: '.$projectId;
	$characterName = $_POST['characterName'];
	$characterDesc = $_POST['characterDesc'];
}

if(empty($characterName) || empty($characterDesc)) {
    $message = "All fields are required, please fix any missing information";
    // include $_SERVER['DOCUMENT_ROOT'].'/app/index.php';
    // exit;
} else if (!empty($characterName) || !empty($characterDesc)) {
    $newChartrId = addCharacter($characterName, $characterDesc, $projectId);
    if ($newChartrId < 1) {
        $message = "There was a problemm adding the chapter to database.";
    } else {
        $message = "Added your new character, keep writing!";
        // header('location:../index.php');
    }
} else {
    $message = "There was an error with the data in the form";
}

$characters = getCharacters($_SESSION['id'], $projectId);
?>
<h4 class="dkstblue-txt">Characters</h4>
<ul>
	<?php // TODO: this will eventually need to be an ajax call, include a pic and have some different user interface
		foreach ($characters as $row) {
			echo '<li><a href="controllers/blocks.php?action=characterDetails&&characterId='.$row['id'].'">'.$row['name'].'</a></li>';
		}
	?>
</ul>
<div>
	<a href="#" class="glyphicon glyphicon-plus btn btn-default expander"></a>
	<div class="expand">
		<form id="new-character">
			<input type="text" class="form-control" name="characterName" placeholder="Name">
			<textarea name="characterDesc" id="character-desc" class="form-control" rows="10" placeholder="Description"></textarea>
			<input type="submit" class="btn btn-default" value="Add Character">
			<input type="hidden" name="projectId" <?php echo 'value="'.$projectId.'"' ?>>
			<input type="hidden" name="action" value="newCharacter">
		</form>
	</div>
</div>
<p><?php echo 'projectId: '.$projectId ?></p>
<script>
$(function() { // this is the same as $(document).ready(function(){});
  jQuery(".expand").hide();
  //toggle the componenet with class expander
  jQuery(".expander").click(function(e)
  {
    jQuery(this).next(".expand").slideToggle(500);

    // Cancel the default action
    e.preventDefault();
  });
});
</script>