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

	$topics = $mysqli->query("SELECT * FROM topic");

	//=====================================================

	if (isset($_GET['book'])) { //**** need to change this to pull the hidden fields
	    $book = $_GET['book'];
	} elseif (isset($_POST['book'])) {
	    $book = $_POST['book'];
	    $chapter = $_POST['chapter'];
	    $verse = $_POST['verse'];
	    $content = $_POST['content'];
	    $sTopics = $_POST['topic'];
	    print_r($sTopics);
	    echo '<br>';

		$insertResult = $mysqli->query("INSERT INTO faith (book, chapter, verse, content) 
										values ('$book', $chapter, $verse, '$content')");
		echo 'insertResult: '.$insertResult.'<br>';
		$lastInsert = $mysqli->insert_id;
		echo 'lastInsert: '.$lastInsert.'<br>';
		foreach ($sTopics as $sTopic) {
			echo "topic: ".$sTopic.'<br';
			$insertTopicResult = $mysqli->query("INSERT INTO scripture_topic (topic_id, faith_id) 
												values ($sTopic, $lastInsert)");
		}
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
						<form action="scripture_topic.php" method="POST">
							<input class="form-contol" type="text" name="book" placeholder="Book"><br>
							<input class="form-contol" type="text" name="chapter" placeholder="Chapter"><br>
							<input class="form-contol" type="text" name="verse" placeholder="Verse"><br>
							<textarea class="form-contol" type="text" name="content" placeholder="Content"></textarea><br>
							<?php foreach ($topics as $topic) {
								echo '<input class="form-contol" type="checkbox" name="topic[]" value="'.$topic['id'].'"/>'.$topic['name'].'<br>';
							} ?>
							<input class="btn btn-default" type="submit" value="Submit">
						</form>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>