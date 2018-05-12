<?php 
function showAlert($type, $message) {

	if ($type == 1) {
?>
		<div class='alert alert-success'><?php echo $message ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
<?php
	} 
	else {
?>
		<div class='alert alert-danger'><?php echo $message ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
<?php
	} // end if-else
} // end function
?>