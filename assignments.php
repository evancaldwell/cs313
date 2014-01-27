<?php 
// Create or access the session
session_start();
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="container">
			<?php include("modules/header.php");?>	
			<main id="main">
				<div class="row">
					<div class="col-md-12">
						<h3>CS 313 Assignments</h3>
						<ul>
							<li><a href="/views/assignments/class_survey.php">Class Survey</a></li>
						</ul>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>
		</div>

		
	</body>
</html>