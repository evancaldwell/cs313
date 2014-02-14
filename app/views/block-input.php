<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require '../models/blocks.php';

$projectId = $_GET['projectId'];

$blocks = getBlocks($_SESSION['id'], $projectId);
$chapters = getChapters($_SESSION['id'], $projectId);
?>
<h4>Add a new block of writing:</h4>
<form action="controllers/blocks.php" method="POST">
	<textarea name="blockContent" id="new-block" class="form-control" cols="70" rows="10"></textarea><br>
	<select name="chapter" id="block-chapter-select" class="form-control">
		<?php foreach ($chapters as $row) {
			echo '<option value="'.$row["id"].'">'.$row['chapter'].' - '.$row["title"].'</option>\n';
		} ?>
	</select>
	<input type="submit" class="btn btn-default" value="Add Block">
	<input type="hidden" name="action" value="newBlock">
</form>
<p><?php echo 'projectId: '.$projectId ?></p>