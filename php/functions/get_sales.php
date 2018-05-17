<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Transaction.php';

$from = $_REQUEST["datefrom"];
$to = $_REQUEST["dateto"];

if (empty($from)) {
	$d = strtotime("12:00am January 1 1900");
	$from = Date('Y-m-d', $d);
}

if (empty($to)) {
	$d = strtotime("tomorrow");
	$to = Date('Y-m-d', $d);
}

$trans = Transaction::getTransactionsBetween($from, $to);

if ($trans == null) {
	echo 0;
	exit();
}

$totalPrice = 0;

foreach ($trans as $tran) {
	$totalPrice += ($tran->price * $tran->quantity);
}

echo $totalPrice;
exit();

 ?>