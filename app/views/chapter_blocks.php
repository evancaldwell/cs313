	<?php 
$_SESSION['id'] = 1;



$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id'], $projectId=1);
//$currentChapter = []; //TODO: get the current chapters info to display above the list of blocks
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body class="mainblue-bk">
		<?php 
			include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php';
			include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php';
		?>
		<div class="container">
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/notifications.php'; ?>
			<main id="main">
				<div id="project-chapter-bar" class="row">
					<div class="col-md-3 col-md-offset-6">
						<p class="sketch-font offwhite-txt">Projects:</p>
						<form action="controllers/blocks.php" method="POST" >
							<select name="projects" id="project-select" class="form-control">
								<?php foreach ($projects as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['title']."</option>\n";
								} ?>
							</select>
						</form>
					</div>
					<div class="col-md-3">
						<p class="sketch-font offwhite-txt">Chapters:</p>
						<form action="controllers/blocks.php" method="POST" >
							<select name="chapters" id="chapter-select" class="form-control">
								<?php foreach ($chapters as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['chapter']." - ".$row["title"]."</option>\n";
								} ?>
							</select>
						</form>
					</div>
					<div class="row">
						<div class="col-md-2">
							<a href="../index.php" class="btn btn-default">Back</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 no-list-style">
						<h4 class="scribe-font offwhite-txt">Blocks for chapter: <?php echo $chapterId ?></h4>
						<ul>
							<?php foreach ($blocks as $row) {
								echo '<li class="main-component offwhite-bk">'.$row['block'].'</li>';
							} ?>
						</ul>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>