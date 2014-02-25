<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="form row">
			<div class="col-md-10 col-md-offset-1">
				<h1>CS 313 in class form test</h1>
				<form action="form_test_out.php" method="post" id="test-form">
					<h3>Name: </h3><input type="text" name="name"><br>
					<h3>Email: </h3><input type="text" name="email"><br>
					<h3>Major: </h3>
					<fieldset>
						<input type="radio" name="major" value="Computer Science">Computer Science<br>
						<input type="radio" name="major" value="Web Development and Design">Web Development and Design<br>
						<input type="radio" name="major" value="Computer Information Technology<">Computer Information Technology<br>
						<input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>
					</fieldset>
					<h3>Places Visited: </h3>
					<fieldset>
						<input type="checkbox" name="places[]" value="North America">North America<br>
						<input type="checkbox" name="places[]" value="South America">South America<br>
						<input type="checkbox" name="places[]" value="Europe">Europe<br>
						<input type="checkbox" name="places[]" value="Asia">Asia<br>
						<input type="checkbox" name="places[]" value="Australia">Australia<br>
						<input type="checkbox" name="places[]" value="Africa">Africa<br>
						<input type="checkbox" name="places[]" value="Antarctica">Antarctica<br>
					</fieldset>
					<h3>Comments: </h3>
					<textarea name="comments"></textarea><br>
					<input type="submit" name="submit"><br>
				</form>
			</div>	
		</div>
	</body>
</html>