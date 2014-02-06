<?php 
// Create or access the session
$_SESSION['loggedin'] = false;
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/head.php'; ?>
	<body>
		<div id="container">
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/menu_bar.php'; ?>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/header.php'; ?>
			<div class="row notification">
				<div class="col-md-12"><?php if (isset($message)) {echo $message;} ?></div>
			</div>
			<main id="main">
				<section id="character-sketches" class="main-component">character sketches will go here</section>
				<section id="block-input" class="main-component">
					<form action="default.php">
						<h4>Add a new block of writing:</h4>
						<textarea name="newBlock" id="new-block" cols="70" rows="10"></textarea>
						<input type="submit" value="Add Block">
					</form>
				</section>
				<section id="timeline" class="main-component">timeline view goes here</section>
				<section id="chapters" class="main-component">
					<h4>Chapter List</h4>
					<ul>
						<li>Chapter 1<span class="chpt-block-cnt">&nbsp;:3</span></li>
						<li>Chapter 2<span class="chpt-block-cnt">&nbsp;:12</span></li>
						<li>Chapter 3<span class="chpt-block-cnt">&nbsp;:1</span></li>
					</ul>
				</section>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/app/modules/footer.php'; ?>
		</div>
	</body>
</html>