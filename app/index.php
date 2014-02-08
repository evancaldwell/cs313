<?php 
// Create or access the session
session_start();

require 'models/blocks.php';

$_SESSION['id'] = 1;

$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id']);
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
					<div class="col-md-2 col-md-offset-10">
						<form action="controllers/blocks.php" method="POST" >
							<select name="projects" id="project-select">
								<?php foreach ($projects as $row) {
									echo "<option value=\"".$row["id"]."\">".$row['title']."</option>\n";
								} ?>
							</select>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<section id="character-sketches" class="main-component">character sketches will go here</section>
						<section id="block-input" class="main-component">
							<form action="controllers/blocks.php" method="POST">
								<h4>Add a new block of writing:</h4>
								<textarea name="blockContent" id="new-block" cols="70" rows="10"></textarea><br>
								<select name="chapter">
									<?php foreach ($chapters as $row) {
										echo "<option value=\"".$row["id"]."\">".$row['chapter']." - ".$row["title"]."</option>\n";
									} ?>
								</select>
								<input type="submit" value="Add Block">
								<input type="hidden" name="action" value="newBlock">
							</form>
						</section>
						<section id="chapters" class="main-component">
							<h4>Chapter List</h4>
							<ul>
								<?php
									foreach ($chapters as $row) {
										echo '<li><a href="controllers/blocks.php?action=chapterBlocks&&chapterId='.$row['id'].'">'.$row['chapter'].' - '.$row['title'].': #</a></li>';
									}
								?>
							</ul>
						</section>
						<section id="timeline" class="main-component">timeline view goes here</section>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>