<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Transaction.php';
$transactions = Transaction::getAllTransaction();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Transactions</title> 
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
							<th>Order Id</th>
							<th>User</th>
							<th>Menu</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>

						<?php
						if ($transactions)
							foreach ($transactions as $transaction) {
						?>
							<tr>
								<td><?php echo $transaction->transactionId ?></td>
								<td><?php echo $transaction->orderId ?></td>
								<td><?php echo $transaction->userName ?></td>
								<td><?php echo $transaction->menuName ?></td>
								<td><?php echo $transaction->formattedDate ?></td>
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