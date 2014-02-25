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
			<input id="character-name" type="text" class="form-control" name="characterName" placeholder="Name">
			<textarea id="character-desc" name="characterDesc" class="form-control" rows="10" placeholder="Description"></textarea>
			<input id="new-character-btn" type="button" class="btn btn-default" value="Add Character" onclick="handleNewCharacterClick(event);">
			<input type="hidden" name="projectId" <?php echo 'value="'.$projectId.'"' ?>>
			<input type="hidden" name="action" value="newCharacter">
		</form>
	</div>
</div>
