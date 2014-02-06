<?php
	// $dsn = 'mysql:localhost;dbname=Scriptures';
	// $username = 'php';
	// $password = 'php-pass';
	
	// try {
	//     $db = new PDO($dsn, $username, $password); // creates a PDO object
	// } catch (PDOException $exc) {
	//     echo 'Connection failed';
	//     exit;
	// }

	// $results = $db->query("SELECT * FROM faith");

	$mysqli = new mysqli("localhost", "php", "php-pass", "Scriptures");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to mysql: ".$mysqli->connect_errno;
	}

	$results = $mysqli->query("SELECT * FROM faith");

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
						<?php while ($row = $results->fetch_assoc()) { ?>
							<h4><?php echo $row["book"]." ".$row["chapter"].":".$row["verse"]."<br>"; ?></h4>
							<p><?php echo $row["content"]."<br><br>"; ?></p>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="scripture_search.php" method="GET">
							<input type="text" name="book">
							<input type="submit">
						</form>
						<?php 
							if (isset($bookList)) { 
								while ($row = $bookList->fetch_assoc()) { 
						?>
							<h4><?php echo $row["book"]." ".$row["chapter"].":".$row["verse"]."<br>"; ?></h4>
							<p><?php echo $row["content"]."<br><br>"; ?></p>
						<?php 
								} 
							}
						?>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>