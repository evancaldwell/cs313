<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require '../models/blocks.php';

$projectId = $_GET['projectId'];

$chapters = getChapters($_SESSION['id'], $projectId);
?>
<h4 class="dkstblue-txt">Chapter List</h4>
<ul>
	<?php
		foreach ($chapters as $row) {
			echo '<li><a href="controllers/blocks.php?action=chapterBlocks&&chapterId='.$row['id'].'">'.$row['chapter'].' - '.$row['title'].': #</a></li>';
		}
	?>
</ul>
<div>
	<a href="#" class="glyphicon glyphicon-plus btn btn-default expander"></a>
	<div class="expand">
		<form action="controllers/blocks.php" method="POST">
			<input type="number" size="3" class="form-control" name="chapterNum" placeholder="Chapter #">
			<input type="text" class="form-control" name="chapterName" placeholder="Title">
			<input type="submit" class="btn btn-default" value="Add Chapter">
			<input type="hidden" name="action" value="newChapter">
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