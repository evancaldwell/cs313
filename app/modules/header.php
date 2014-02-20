<?php
require_once $_SERVER['DOCUMENT_ROOT']."/conn/connAdmin.php";
$dir = sys_get_temp_dir();
session_save_path($dir);
?>
<div id="pag-header" class="row">
	<div class="logo">
		<img src="" alt="">
	</div>
	<h1>
		<span class="logo-style-1 logo-style logo-text">Scribe</span><span class="logo-style-2 logo-style logo-text">Sketch</span>
		<small>Write Simply... When ever... Where ever</small>
	</h1>
</div>