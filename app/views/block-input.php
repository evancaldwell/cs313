<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require '../models/blocks.php';

if (isset($_GET['projectId'])) {
	$projectId = $_GET['projectId'];
	$_SESSION['projectId'] = $projectId;
} elseif (isset($_POST['projectId'])) {
	$projectId = $_POST['projectId'];
	$_SESSION['projectId'] = $projectId;
	$blockContent = $_POST['blockContent'];
	$chapter = $_POST['chapter'];
}

$blocks = getBlocks($_SESSION['id'], $_SESSION['projectId']);
$chapters = getChapters($_SESSION['id'], $_SESSION['projectId']);
?>
<h4 class="dkstblue-txt">Add a new block of writing:</h4>
<form action="controllers/blocks.php" method="POST">
	<textarea id="block-content" name="blockContent" class="form-control ckeditor" cols="70" rows="10"></textarea><br>
	<!-- <script type="text/javascript">	CKEDITOR.replace( 'block-content' ); </script> -->
	<select id="block-chapter-select" name="chapter" class="form-control">
		<?php foreach ($chapters as $row) {
			echo '<option value="'.$row["id"].'">'.$row['chapter'].' - '.$row["title"].'</option>\n';
		} ?>
	</select>
	<input id="new-block-btn" type="button" class="btn btn-default" value="Add Block" onclick="handleNewBlockClick(event);">
	<input type="hidden" name="action" value="newBlock">
</form>