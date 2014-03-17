<?php 
// Create or access the session
session_start();
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="wrap">
			<div class="container">
				<?php include("modules/main-menu.php");?>
				<?php include("modules/header.php");?>	
				<main id="main">
					<div class="row">
						<div class="col-md-12 content-block">
							<h3>CS 313 Assignments</h3>
							<ul>
								<li><a href="/views/assignments/class_survey.php">Class Survey</a></li>
								<li><a href="http://ec2-54-209-229-29.compute-1.amazonaws.com:8080/forum/signin.jsp">Java Forum (username: test, password: pass)</a></li>
							</ul>
						</div>
					</div>
				</main>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>
			</div>
		</div>
	</body>
</html>