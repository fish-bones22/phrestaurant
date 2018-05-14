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
	public $timestamp;
	public $formattedDate;

	function setValues($transactionId, $userId, $orderId, $menuId, $price) {
		$this->transactionId = $transactionId;
		$this->userId = $userId;
		$this->orderId = $orderId;
		$this->menuId = $menuId;
		$this->price = $price;
	}

	function setValuesByArray($transaction_array) {
		$this->transactionId = $transaction_array["transaction_id"];
		$this->userId = $transaction_array["user_id"];
		$this->userName = $transaction_array["user_first_name"]." ".$transaction_array["user_last_name"];
		$this->orderId = $transaction_array["order_id"];
		$this->menuId = $transaction_array["menu_id"];
		$this->price = $transaction_array["menu_price"];
		$this->menuName = $transaction_array["menu_name"];
		$this->timestamp = $transaction_array["transaction_timestamp"];
		$this->formattedDate = $transaction_array["formatted_date"];
	}

	function getAllTransaction() {

		$db = getDb();

		$select_query = "SELECT *,
		DATE_FORMAT(transaction_table.transaction_timestamp, '%b %d, %Y') as formatted_date 
		FROM transaction_table
		LEFT JOIN menu_table ON transaction_table.menu_id = menu_table.menu_id
		LEFT JOIN user_table ON transaction_table.user_id = user_table.user_id
		";

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