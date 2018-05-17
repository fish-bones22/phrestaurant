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
	<link href="vendors/datatables/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="h2">Transactions</div>
				<table class="table table-sm" id="transaction-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Trans</th>
							<th>Cashier</th>
							<th>Menu</th>
							<th>Quantity</th>
							<th>Price</th>
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
								<td>Trans #<?php echo $transaction->orderId ?></td>
								<td><?php echo $transaction->userName == "" ? "[Deleted]" : $transaction->userName ?></td>
								<td><?php echo $transaction->menuName == "" ? "[Deleted]" : $transaction->menuName ?></td>
								<td><?php echo $transaction->quantity ?></td>
								<td><?php echo $transaction->price*$transaction->quantity ?></td>
								<td><?php echo $transaction->formattedDate ?></td>
							</tr>
						<?php
							}
						?>
						
					</tbody>
				</table>
			</div>

			<div class="col-lg-4">
				<div><span class="h5">Total Sales: </span><span id="total-sales" class="lead">0</span></div>
				<div class="form-group">
					<div class="row">
						<div class="col-2">
							<label>From:</label>
						</div>
						<div class="col">
							<input class="form-control ml-3" max="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>" type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="date_from" />
						</div>
					</div>
					<div class="row">
						<div class="col-2">
							<label>To:</label>
						</div>
						<div class="col">
							<input class="form-control ml-3" max="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>" type="date" name="date_to" />
						</div>
					</div>
					<div class="form-group mt-2">
						<button class="btn btn-block btn-sm" onclick="getTotalSales()">Filter</button>
					</div>
				</div>
			</div>

		</div>
	</div>
	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendors/datatables/js/datatables.min.js"></script>
	<script src="vendors/datatables/js/dataTables.rowGroup.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/transaction.js"></script>
</body>
</html>