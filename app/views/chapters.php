<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require '../models/blocks.php';

$projectId = $_GET['projectId'];

$chapters = getChapters($_SESSION['id'], $projectId);
?>
<h4>Chapter List</h4>
<ul>
	<?php
		foreach ($chapters as $row) {
			echo '<li><a href="controllers/blocks.php?action=chapterBlocks&&chapterId='.$row['id'].'">'.$row['chapter'].' - '.$row['title'].': #</a></li>';
		}
	?>
</ul>
<form action="controllers/blocks.php" method="POST">
	<input type="number" size="3" class="form-control1" name="chapterNum" placeholder="#">
	<input type="text" class="form-control1" name="chapterName" placeholder="Title">
	<input type="submit" class="btn btn-default" value="Add Chapter">
	<input type="hidden" name="action" value="newChapter">
</form>
<p><?php echo 'projectId: '.$projectId ?></p>