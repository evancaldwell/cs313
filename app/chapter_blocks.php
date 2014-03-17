<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require 'models/blocks.php';

if (isset($_GET['chapterId'])) {
	$chapterId = $_GET['chapterId'];
	// $blocks = $_GET['blocks'];
} elseif (isset($_POST['chapterId'])) {
	$chapterId = $_POST['chapterId'];
	$blocks = $_POST['blocks'];
}



$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id'], $_SESSION['projectId']);
$blocks = getBlocks($_SESSION['id'], $chapterId);
//$currentChapter = []; //TODO: get the current chapters info to display above the list of blocks
?>
<!DOCTYPE html>
<html>
	<?php include 'modules/head.php'; ?>
	<body class="mainblue-bk">
		<?php 
			include 'modules/menu_bar.php';
			include 'modules/header.php';
		?>
		<div class="container">
			<?php include 'modules/notifications.php'; ?>
			<main id="main">
				<div class="row">
					<div class="col-md-2">
						<?php echo '<a href="index.php?chapterId='.$chapterId.'" class="btn btn-default">Back</a>' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 no-list-style">
						<h4 class="scribe-font offwhite-txt">Blocks for this chapter:</h4>
						<ul>
							<?php foreach ($blocks as $row) {
								echo '<li class="main-component offwhite-bk">'.$row['block'].'</li>';
							} ?>
						</ul>
					</div>
				</div>
			</main>
			<?php include 'modules/footer.php'; ?>
		</div>
	</body>
</html>