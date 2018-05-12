<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Log.php';
$logs = Log::getLogs();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Daily Time Record</title> 
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="vendors/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<table class="table table-sm" id="log-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Log in</th>
							<th>Log out</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>

						<?php
						if ($logs)
							foreach ($logs as $log) {
						?>
							<tr>
								<td><?php echo $log->id ?></td>
								<td><?php echo $log->name ?></td>
								<td><?php echo $log->login ?></td>
								<td><?php echo $log->logout ?></td>
								<td><?php echo $log->date ?></td>
							</tr>
						<?php
							}
						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendors/datatables/js/datatables.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/loghistory.js"></script>
</body>
</html>