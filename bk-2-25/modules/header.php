<?php
require_once $_SERVER['DOCUMENT_ROOT']."/conn/connAdmin.php";
$dir = sys_get_temp_dir();
session_save_path($dir);
?>
<div id="header" class="row">
	<div class="col-md-5">
		<div class="logo">
			<img src="" alt="">
		</div>
		<div class="title">
			<h1>Evan Caldwell</h1>
			<p id="subtitle">CS313 worksite</p>
		</div>
	</div>
</div>