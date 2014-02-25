<?php if (isset($successMessage)) { ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Success!</strong> <?php echo $successMessage; ?>
	</div>
<?php } elseif (isset($infoMessage)) { ?>
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $infoMessage; ?>
	</div>
<?php } elseif (isset($warningMessage)) { ?>
	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Warning!</strong> <?php echo $warningMessage; ?>
	</div>
<?php } elseif (isset($dangerMessage)) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Danger!</strong> <?php echo $dangerMessage; ?>
	</div>
<?php } elseif (isset($message)) { ?>
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $message; ?>
	</div>
<?php } ?>