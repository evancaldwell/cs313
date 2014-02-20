<?php 
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require 'models/blocks.php';

$_SESSION['id'] = 1;

$projects = getProjects($_SESSION['id']);
$chapters = getChapters($_SESSION['id'], $projectId=1);
$characters = getCharacters($_SESSION['id'], $projectId=1);
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body class="solid-bk">
		<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php'; ?>
		<div class="container">
			<?php 
				include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php';
				include $_SERVER['DOCUMENT_ROOT'].'/app/modules/notifications.php';
			?>

			<main id="main">
				<div class="row">
					<div class="col-md-2 col-md-offset-8">
						<form action="controllers/blocks.php" method="POST" class="form-inline">
							<select name="projects" id="project-select" class="form-control">
								<?php foreach ($projects as $row) {
									echo '<option id="project"'.$row["id"].'" value="'.$row["id"].'">'.$row['title'].'</option>\n';
								} ?>
							</select>
						</form>
					</div>
					<div class="col-md-2">
						<div>
							<a href="#" class="glyphicon glyphicon-plus btn btn-default expander"></a>
							<div class="expand">
								<form action="controllers/blocks.php" method="POST">
									<input type="text" class="form-control" name="projectTitle" placeholder="Project Title">
									<input type="text" class="form-control" name="projectDesc" placeholder="Project Description">
									<input type="submit" class="btn default-btn" value="Add Project">
									<input type="hidden" name="action" value="newProject">
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<section id="character-sketches" class="main-component">
							<h4>Characters</h4>
							<ul>
								<?php // TODO: this will eventually need to be an ajax call, include a pic and have some different user interface
									foreach ($characters as $row) {
										echo '<li><a href="controllers/blocks.php?action=characterDetails&&characterId='.$row['id'].'">'.$row['name'].'</a></li>';
									}
								?>
							</ul>
							<div>
								<a href="#" class="glyphicon glyphicon-plus btn btn-default expander"></a>
								<div class="expand">
									<form id="new-character">
										<input type="text" class="form-control" name="characterName" placeholder="Name">
										<textarea name="characterDesc" id="character-desc" class="form-control" rows="10" placeholder="Description"></textarea>
										<input type="submit" class="btn btn-default" value="Add Character">
										<input type="hidden" name="projectId" <?php echo 'value="'.$projectId.'"' ?>>
										<input type="hidden" name="action" value="newCharacter">
									</form>
								</div>
							</div>
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
						</section>
					</div>
					<div class="col-md-8">
						<section id="block-input" class="main-component">
							<form action="controllers/blocks.php" method="POST">
								<h4>Add a new block of writing:</h4>
								<textarea name="blockContent" id="new-block" class="form-control ckeditor" cols="70" rows="10"></textarea><br>
								<select name="chapter" id="block-chapter-select" class="form-control">
									<?php foreach ($chapters as $row) {
										echo '<option value="'.$row["id"].'">'.$row['chapter'].' - '.$row["title"].'</option>\n';
									} ?>
								</select>
								<input type="submit" class="btn btn-default" value="Add Block">
								<input type="hidden" name="action" value="newBlock">
							</form>
						</section>
					</div>
					<div class="row">
						<div class="col-md-12">
							<section id="timeline" class="main-component">timeline view goes here</section>
						</div>
					</div>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>