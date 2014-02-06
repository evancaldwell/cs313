<?php 
// Create or access the session
session_start();
?>
<!DOCTYPE html>
<html>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>
	<body>
		<div class="container">
			<?php include("modules/main-menu.php");?>
			<?php include("modules/header.php");?>
			<main id="main">
				<div class="row">
					<div class="col-md-12 content-block">
						<h1>Basic Stuff</h1>
						<p>I'm just a normal kind of guy who is married to a beautiful woman and has 4 awesome 
						kids. They call me a "non-traditional" student because I started school here - well, at 
						Ricks College - in 1998, then I left to work in business for 10 years and now I'm back. 
						I think my perspecive is a little different because of that, I'm not here for a high GPA 
						or to be class president. I'm here to fill in the gaps with some knowledge and experience 
						so I can go do what I love - and make some killer, world-changing, brain melting awesomeness 
						out there in the cloud.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 content-block">
						<h1>Connect</h1> <!-- TODO: these should maybe be icons or tiles or something more visual -->
						<ul>
							<li><a href="">LinkedIn</a></li>
							<li><a href="">Facebook</a></li>
							<li><a href="">Google+</a></li>
							<li><a href="">Twitter</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 content-block">
						<h1>Work</h1>
						<a href="">
							<div class="portfolio-item">
								<img src="" alt="">
								<h4>jaed.evancaldwell.com</h4>
								<p>A PHP website I created for a class</p>
							</div>
						</a>
						<hr>
						<a href="">
							<div class="portfolio-item">
								<img src="" alt="">
								<h4>Data Collection Platform</h4>
								<p>A project I managed for a non-profit client. It is meant to help them 
								gather data from remote areas in third world countries and provide intuitive 
								interfaces for looking at that data.</p>
							</div>
						</a>
						<hr>
						<a href="">
							<div class="portfolio-item">
								<img src="" alt="">
								<h4>QR Code Platform</h4>
								<p>A project I managed that gives museums, art galleries, universities, etc. 
								a simple and effective way to implement QR codes as a mechanism to get more 
								info, engage and learn.</p>
							</div>
						</a>
						<hr>
						<a href="">
							<div class="portfolio-item">
								<img src="" alt="">
								<h4>Conference Management Platform</h4>
								<p>A project I managed to allow easy integrated management of conferences. It 
								includes interfaces for working with participants, judges and staff.</p>
							</div>
						</a>
						<hr>
						<a href="">
							<div class="portfolio-item">
								<img src="" alt="">
								<h4>feedtheworld.org</h4>
								<p>A website re-work for a non-profit client on Wordpress. They needed and new 
								look and feel as well as a simplified way for staff to add content and some 
								additional tools.</p>
							</div>
						</a>
						<hr>
						<a href="">
							<div class="portfolio-item">
								<img src="" alt="">
								<h4>Single Product Site Concept</h4>
								<p>This is a concept for a business that has only one product, I uses and unique 
								and intuitive interface to create a certain feeling that draws the visitor to 
								the product.</p>
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 content-block">
						<h1>Fun</h1>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>
		</div>
	</body>
</html>