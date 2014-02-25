<!DOCTYPE html>
<html>
	<?php
		$names = ["Evan","Kevin","Ben","Vader","Luke","Han"];
		foreach ($names as $key => $value) {
			echo '<div id="'.$key.'">'.$value.'</div>';
		}
	?>
</html>