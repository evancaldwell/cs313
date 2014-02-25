<?php 
// Create or access the session
session_start();
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="container">
			<?php include("modules/header.php");?>
			<main id="main">
				<div class="row">
					<div id="home-wrapper" class="center-block">
						<img id="body-img" class="center-block" src="img/full_body_md.png" alt="large image of me">
						<div id="rad1" class="radial-div">
							<a href="assignments.php">Assignments&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></a>
						</div>
						<div id="rad2" class="radial-div">
							<a href="/app/index.php">App&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></a>
						</div>
						<div id="rad3" class="radial-div">
							<a href="about.php"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;About Me</a>
						</div>
						<div id="rad4" class="radial-div">
							<a href="#"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Blog</a>
						</div>
						<div id="horiz-divider"></div>
						<div class="home-qtr" id="hqtr1"></div>
						<div class="home-qtr" id="hqtr2"></div>
						<div class="home-qtr" id="hqtr3"></div>
						<div class="home-qtr" id="hqtr4"></div>
						<div class="home-angle" id="hang-top"></div>
						<div class="home-angle" id="hang-bottom"></div>
						<!-- TODO: create a paralax effect with the image and have stuff under my feet -->
					</div>
					<!-- <img id="body-img" src="/img/full_body_md.png"> -->
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>
		</div>

		
	</body>

	<script type="text/javascript">
		window.onresize = radialFormat("onresize");
	</script>
</html>