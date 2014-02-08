<?php 
$_SESSION['id'] = 1;



$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id']);
$currentChapter = []; //TODO: get the current chapters info to display above the list of blocks
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body>
		<div id="container">
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php'; ?>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php'; ?>
			<div class="row notification">
				<div class="col-md-12"><?php if (isset($message)) {echo $message;} ?></div>
			</div>
			<main id="main">
				<div class="row">
					<div class="col-md-4 col-md-offset-8 select-bar">
						<p>Projects:</p>
						<form action="controllers/blocks.php" method="POST" >
							<select name="projects" id="project-select">
								<?php foreach ($projects as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['title']."</option>\n";
								} ?>
							</select>
						</form>
						<p>Chapters:</p>
						<form action="controllers/blocks.php" method="POST" >
							<select name="chapters" id="chapter-select">
								<?php foreach ($chapters as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['chapter']." - ".$row["title"]."</option>\n";
								} ?>
							</select>
						</form>
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
		</div>
	</body>
</html>