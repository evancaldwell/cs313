<?php

?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="container">
			<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/header.php'; 	?>
			<main id="main">
				<div class="row">
					<div class="col-md-12">
						<form action="auth_controller.php" method="POST" id="signup">
							<input type="text" class="form-control" name="username" placeholder="Enter Username/Email">
							<input type="password" class="form-control" name="pass1" placeholder="Enter Your Password">
							<input type="password" class="form-control" name="pass2" palceholder="Confirm Your Password">
							<input type="submit" class="btn default-btn" value="Sign Up">
							<input type="hidden" name="action" value="signup">
						</form>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>