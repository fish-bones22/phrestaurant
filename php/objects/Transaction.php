<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

class Transaction {
	public $transactionId;
	public $userId;
	public $orderId;
	public $menuId;
	public $timestamp;

	function setValues($transactionId, $userId, $orderId, $menuId) {
		$this->transactionId = $transactionId;
		$this->userId = $userId;
		$this->orderId = $orderId;
		$this->menuId = $menuId;
	}

	function setValuesByArray($transaction_array) {
		$this->transactionId = $transaction_array["transaction_id"];
		$this->userId = $transaction_array["user_id"];
		$this->orderId = $transaction_array["order_id"];
		$this->menuId = $transaction_array["menu_id"];
		$this->timestamp = $transaction_array["transaction_timestamp"];
	}

	function getAll() {

		$db = getDb();

		$select_query = "SELECT * FROM transaction_table";

		$result = $db->query($select_query);

		$db->close();

		if (!$result || $result->num_rows <= 0)
			return null;

		$transactions = [];

		while ($row = mysqli_fetch_array($result)) {

			$transac = new Transaction(); 
			$transac->setValuesByArray($row);
			$transactions[$transac->id] = $transac;

		}

		return $transactions;
	}
}

?>