<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require_once 'models/blocks.php';

if (isset($_GET['projectId'])) {
	$projectId = $_GET['projectId'];
	$_SESSION['projectId'] = $projectId;
} elseif (isset($_POST['projectId'])) {
	$projectId = $_POST['projectId'];
	$_SESSION['projectId'] = $projectId;
	$chapterNum = $_POST['chapterNum'];
	$chapterName = $_POST['chapterName'];
}

$chapters = getChapters($_SESSION['id'], $_SESSION['projectId']);
?>
<h4 class="dkstblue-txt">Chapter List</h4>
<ul>
	<?php
		foreach ($chapters as $row) {
			echo '<li><a href="../controllers/blocks.php?action=chapterBlocks&&chapterId='.$row['id'].'">'.$row['chapter'].' - '.$row['title'].'</a></li>';
		}
	?>
</ul>
<div>
	<a href="#" class="glyphicon glyphicon-plus btn btn-default expander"></a>
	<div class="expand">
		<form action="controllers/blocks.php" method="POST">
			<input id="chapter-number" type="number" size="3" class="form-control" name="chapterNum" placeholder="Chapter #">
			<input id="chapter-name" type="text" class="form-control" name="chapterName" placeholder="Title">
			<input id="new-chapter-btn" type="button" class="btn btn-default" value="Add Chapter" onclick="handleNewChapterClick(event);">
			<input type="hidden" name="action" value="newChapter">
		</form>
	</div>
</div>