<?php 
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require_once 'models/blocks.php';

// check to see if any notification messages have been passed to $_GET and then display the proper one
if (isset($_GET['successMessage'])) {
	$successMessage = $_GET['successMessage'];
} elseif (isset($_GET['warningMessage'])) {
	$warningMessage = $_GET['warningMessage'];
} elseif (isset($_GET['dangerMessage'])) {
	$dangerMessage = $_GET['dangerMessage'];
} elseif (isset($_GET['infoMessage'])) {
	$infoMessage = $_GET['infoMessage'];
} elseif (isset($_GET['message'])) {
	$infoMessage = $_GET['message'];
}

$projects = getProjects($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body class="mainblue-bk">
		<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php'; ?>
		<div class="container">
			<?php 
				// include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php';
				include $_SERVER['DOCUMENT_ROOT'].'/app/modules/notifications.php';
			?>
			<main id="main">
				<?php if (count($projects) >= 1) { ?>
					<div id="project-tiles" class="row">
						<h1 class="sketch-font offwhite-txt">Select a Project:</h1>
						<?php foreach ($projects as $project) { ?>
							<div class="col-md-4">
								<?php 
								echo '<div id="'.$project['id'].'" class="main-component project-tile offwhite-bk cursor-pointer">';
									echo $project['title'];
								echo '</div>';
								?>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="col-md-12">
							<h2 class="scribe-font offwhite-txt">Please add your first project:</h2>
						</div>
							<div class="col-md-4">
							<form action="controllers/blocks.php" method="POST">
								<input type="text" class="form-control" name="projectTitle" placeholder="Project Title">
								<input type="text" class="form-control" name="projectDesc" placeholder="Project Description">
								<input type="submit" class="btn default-btn" value="Add Project">
								<input type="hidden" name="action" value="newProject">
							</form>
						</div>
					</div>
				<?php } ?>
				<div id="main-dash">
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
							<section id="character-sketches" class="main-component offwhite-bk">
							</section>
							<section id="chapters" class="main-component offwhite-bk">
							</section>
						</div>
						<div class="col-md-8">
							<section id="block-input" class="main-component offwhite-bk">
							</section>
						</div>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>