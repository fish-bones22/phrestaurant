<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

class Transaction {
	public $transactionId;
	public $userId;
	public $userName;
	public $orderId;
	public $menuId;
	public $menuName;
	public $price;
	public $quantity;
	public $timestamp;
	public $formattedDate;

	function setValues($transactionId, $userId, $orderId, $menuId, $price, $quantity) {
		$this->transactionId = $transactionId;
		$this->userId = $userId;
		$this->orderId = $orderId;
		$this->menuId = $menuId;
		$this->price = $price;
		$this->quantity = $quantity;
	}

	function setValuesByArray($transaction_array) {
		$this->transactionId = $transaction_array["transaction_id"];
		$this->userId = $transaction_array["user_id"];
		$this->userName = $transaction_array["user_name"];
		$this->orderId = $transaction_array["order_id"];
		$this->menuId = $transaction_array["menu_id"];
		$this->price = $transaction_array["menu_price_single"];
		$this->quantity = $transaction_array["menu_quantity"];
		$this->menuName = $transaction_array["menu_name"];
		$this->timestamp = $transaction_array["transaction_timestamp"];
		$this->formattedDate = $transaction_array["formatted_date"];
	}

	function getAllTransaction() {

		$db = getDb();

		$select_query = "SELECT *,
		DATE_FORMAT(transaction_table.transaction_timestamp, '%b %d, %Y') as formatted_date 
		FROM transaction_table";

		$result = $db->query($select_query);

		$db->close();

		if (!$result || $result->num_rows <= 0)
			return null;

		$transactions = [];

		while ($row = mysqli_fetch_array($result)) {

			$transac = new Transaction(); 
			$transac->setValuesByArray($row);
			$transactions[$transac->transactionId] = $transac;

		}

		return $transactions;
	}


	function getTransactionsBetween($from, $to) {

		$db = getDb();

		$select_query = "SELECT *,
		DATE_FORMAT(transaction_timestamp, '%b %d, %Y') as formatted_date 
		FROM transaction_table WHERE transaction_timestamp BETWEEN '$from' AND '$to'";

		$result = $db->query($select_query);

		$db->close();

		if (!$result || $result->num_rows <= 0)
			return null;

		$transactions = [];

		while ($row = mysqli_fetch_array($result)) {

			$transac = new Transaction(); 
			$transac->setValuesByArray($row);
			$transactions[$transac->transactionId] = $transac;

		}

		return $transactions;
	}
}

?>