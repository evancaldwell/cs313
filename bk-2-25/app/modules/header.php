<?php
require_once $_SERVER['DOCUMENT_ROOT']."/conn/connAdmin.php";
$dir = sys_get_temp_dir();
session_save_path($dir);
?>
<div id="page-header" class="row offwhite-bk">
	<div class="logo">
		<img src="" alt="">
	</div>
	<h1>
		<span class="scribe-font dkblue-txt logo-text">Scribe</span><span class="sketch-font dkblue-txt logo-text">Sketch</span>
		<small>Write Simply... When ever... Where ever</small>
	</h1>
</div>