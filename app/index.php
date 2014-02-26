<?php 
// Create or access the session
if (!isset($_SESSION)) {
	session_start();
}

require_once 'models/users.php';

// $_SESSION['id'] = 11;
if (isset($_SESSION['loggedin'])) {
	if ($_SESSION['loggedin'] == true) {
		header('location: home.php');
	}
}

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

?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body class="dkblue-bk">
		<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php'; ?>
		<div class="container">
			<?php 
				include $_SERVER['DOCUMENT_ROOT'].'/app/modules/notifications.php';
			?>
			<main id="main">
				<div class="row">
					<div class="col-md-2 col-md-offset-5">
						<h1><span class="scribe-font mainblue-txt">Sign</span> <span class="sketch-font mainblue-txt">Up</span></h1>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<form action="users.php" method="POST">
	                        <fieldset>
	                        	<input type="text" class="form-control" name="email" placeholder="Email" required>
	                        	<input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
	                        	<input type="password" class="form-control" name="pass2" id="pass2" onkeyup="checkPass(event); return false;" placeholder="Confirm Password" required>
	                        <span id="pass-match-mssg"></span>
	                        </fieldset>
	                        <fieldset>
	                        	<input type="text" class="form-control" name="fname" placeholder="First Name" required>
	                        	<input type="text" class="form-control" name="lname" placeholder="Last Name" required>
	                        	<input type="text" class="form-control" name="phone" placeholder="Phone Number">
	                        	<input type="text" class="form-control" name="addr1" placeholder="Street Address">
	                        	<input type="text" class="form-control" name="addr2" placeholder="Apt. #...">
	                        	<input type="text" class="form-control" name="city" placeholder="City">
	                        	<input type="text" class="form-control" name="state" placeholder="State">
	                        	<input type="text" class="form-control" name="zip" placeholder="Zip">
	                        </fieldset>
	                        <input type="submit" class="btn default-btn" value="Register">
	                        <input type="hidden" name="action" value="register">
	                    </form>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>