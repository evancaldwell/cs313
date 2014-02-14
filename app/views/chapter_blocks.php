<?php 
$_SESSION['id'] = 1;



$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id']);
//$currentChapter = []; //TODO: get the current chapters info to display above the list of blocks
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php'; ?>
		<div class="container">
			<?php 
				include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php';
				include $_SERVER['DOCUMENT_ROOT'].'/app/modules/notifications.php';
			?>
			<main id="main">
				<div class="row">
					<div class="col-md-4 col-md-offset-7 select-bar">
						<p>Projects:</p>
						<form action="controllers/blocks.php" method="POST" >
							<select name="projects" id="project-select" class="form-control">
								<?php foreach ($projects as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['title']."</option>\n";
								} ?>
							</select>
						</form>
						<p>Chapters:</p>
						<form action="controllers/blocks.php" method="POST" >
							<select name="chapters" id="chapter-select" class="form-control">
								<?php foreach ($chapters as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['chapter']." - ".$row["title"]."</option>\n";
								} ?>
							</select>
						</form>
					</div>
					<div class="col-md-2">
						<a href="../index.php" class="btn btn-default">Back</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Blocks for chapter: <?php echo $chapterId ?></h4>
						<ul>
							<?php foreach ($blocks as $row) {
								echo '<li>'.$row['block'].'</li>';
							} ?>
						</ul>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>