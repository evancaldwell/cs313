<?php
require_once $_SERVER['DOCUMENT_ROOT']."/conn/connAdmin.php";
$dir = sys_get_temp_dir();
session_save_path($dir);
?>
<div id="pag-header" class="row">
	<div class="logo">
		<img src="" alt="">
	</div>
	<h1>ScribeSketch <small>Write Simply... When ever... Where ever</small></h1>
</div>