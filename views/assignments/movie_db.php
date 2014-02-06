<?php

	$mysqli = new mysqli("localhost", "php", "php-pass", "cs313");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to mysql: ".$mysqli->connect_errno;
	}

	$results = $mysqli->query("SELECT * FROM actor");


	//=====================================================

	if (isset($_GET['book'])) { //**** need to change this to pull the hidden fields
	    $book = $_GET['book'];
	} elseif (isset($_POST['book'])) {
	    $book = $_POST['book'];
	}

	if (isset($book)) {
		$bookList = $mysqli->query("SELECT * FROM faith WHERE book = $book");
	}
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
						<h4>Actors</h4>
						<form>
							<select name="actor" onchange="handleActorDropdown(this)">
								<?php while ($row = $results->fetch_assoc()) {
									echo "<option value = \"".$row["id"]."\">".$row["name"]."</option>\n";
								} ?>
							</select>
						</form>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>
		</div>
	</body>
</html>