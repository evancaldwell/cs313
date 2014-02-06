<?php
require_once $_SERVER['DOCUMENT_ROOT']."/conn/connAdmin.php";
$dir = sys_get_temp_dir();
session_save_path($dir);
?>
<div id="header" class="row">
	<div class="col-md-12">
		<div class="logo">
			<img src="" alt="">
		</div>
		<div class="title">
			<h1>ScribeSketch</h1>
			<p id="subtitle">Write... Simply... When ever... Where ever</p>
		</div>
	</div>
</div>