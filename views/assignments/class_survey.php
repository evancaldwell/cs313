<?php 
// Create or access the session
session_start();
if (isset($_SESSION["voted"])) {
	if ($_SESSION["voted"]) {
		// redirect to results
		header("Location: /views/assignments/class_survey_result.php");
	}
}
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="container">
			<?php include("/modules/header.php"); ?>
			<main id="main">
				<div class="form row">
					<div class="col-md-10 col-md-offset-1">
						<h1>CS 313 Class Survey <span style="font-size:50%;padding-left:20px"><a href="class_survey_result.php">go directly to results</a></span></h1>
						<form action='class_survey_result.php' method="post" id="test-form">
							<h3>Name: </h3><input type="text" name="name"><br>
							<h3>Email: </h3><input type="text" name="email"><br>
							<h3>Major: </h3>
							<fieldset>
								<input type="radio" name="major" value="Computer Science">Computer Science<br>
								<input type="radio" name="major" value="Web Development and Design">Web Development and Design<br>
								<input type="radio" name="major" value="Computer Information Technology<">Computer Information Technology<br>
								<input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>
							</fieldset>
							<h3>What kind of app would you be most interested in? </h3>
							<fieldset>
								<input type="radio" name="app" value="writing">An app that helps me write papers/stories/books more easily<br>
								<input type="radio" name="app" value="freeapp">An app that shows me where to get free apps or deals on apps<br>
								<input type="radio" name="app" value="funny">An app that lets me share specific funny things with my friends<br>
								<input type="radio" name="app" value="university">An app that connects me to my classes, homework and schedule<br>
								<input type="radio" name="app" value="list">An app that helps me stay organized with lists/tasks<br>
								<input type="radio" name="app" value="learning">An app that helps me learn new things on my own<br>
								<input type="radio" name="app" value="mosaic">An app that lets me make a mosaic from my photos to share with friends/family<br>
							</fieldset>
							<h3>Comments: </h3>
							<textarea name="comments" class="form-control" rows="15" cols="50"	 placeholder="Anything to add?"></textarea><br>
							<input type="submit" name="submit"><br>
							<input type="hidden" name="action" value="submitSurvey">
						</form>
					</div>	
				</div>
			</main>
		</div>
	</body>
</html>