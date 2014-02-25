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
						<form action="auth_controller.php" method="POST" id="login">
							<input type="email" class="form-control" name="username">
							<input type="password" class="form-control" name="password">
							<input type="submit" class="btn defaulth-btn" value="Login">
							<input type="hidden" name="action" value="login">
						</form>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>