<?php
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id'], $_SESSION['projectId']);
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
						<a href="../index.php" class="btn btn-default">Back</a>
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