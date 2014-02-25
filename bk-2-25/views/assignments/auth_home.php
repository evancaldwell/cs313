<?php
session_start();
$message = $_GET['message'];
$username = $_GET['username'];
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
						<h1><?php echo 'Welcome '.$_SESSION['username'].'<br>' ?></h1>
						<p><?php echo $message ?></p>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>