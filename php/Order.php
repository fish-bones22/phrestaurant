<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';
	

	if (!isset($_REQUEST['action'])) {
		$action = "showOrder";
	}

	if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
	}

	if ($action == "addUpdate") {
		addUpdateOrder($_REQUEST['id']);
	} elseif ($action == "deleteItem") {
		deleteOneOrder();
	} elseif ($action == "showOrder") {
		showOrderList();
	} elseif ($action == "checkOut") {
		checkOutOrder();
	}

	function addUpdateOrder($menuId) {

		$id = $_REQUEST['id'];

		$select_query = "SELECT * FROM order_table WHERE menu_id = '".$id."'";

		$db = getDb();

		$select_result = $db->query($select_query);

		if ($select_result->num_rows <= 0) {
			$select_order = "SELECT * FROM transaction_table ORDER BY order_id DESC";

			$order_result = $db->query($select_order);

			$order = $order_result->fetch_assoc();

			if (!$order) {
				$order_id = 1;
			} else {
				$order_id = $order["order_id"] + 1; 
			}

			$select_query = "SELECT * FROM menu_table WHERE menu_id = '".$id."'";

			$select_result = $db->query($select_query);

			$row = $select_result->fetch_assoc();

			$add_query = "INSERT INTO order_table (order_id,
												   menu_id,
												   order_quantity)
												   VALUES ('".$order_id."',
												   		   '".$row["menu_id"]."',
												   		   '1')";

			$result = $db->query($add_query);

			$db->close();

			if (!$result) return faslse;

		} else {
			$quantity_order = $select_result->fetch_assoc();

			$quantity = $quantity_order["order_quantity"] + 1;

			$update_query = "UPDATE order_table SET 
							 order_quantity = '".$quantity."'
							 WHERE menu_id = '".$id."'";

			$result = $db->query($update_query);

			$db->close();

			if (!$result) return false;
		}

		echo json_encode($result);
	}

	function deleteOneOrder() {
		$id = $_REQUEST['id'];

		$delete_query = "DELETE FROM order_table WHERE table_order_id = '".$id."'";

		$db = getDb();

		$result = $db->query($delete_query);

		$db->close();

		if (!$result) return false;
	}

	function showOrderList() {
		$select_query = "SELECT * FROM order_table";

		$db = getDb();

		$result = $db->query($select_query);

		echo '<table>';
	    while($row = $result->fetch_assoc()) {
        echo '<tr>'
        		.'<td><button onclick="deleteItem(this)" data-id="'.$row["table_order_id"].'">DELETE</button></td>'
	            .'<td>'.$row["menu_id"].'</td>'
	            .'<td>'.$row["order_quantity"].'</td>'
	            .'</tr>';
	    }
	    echo '</table>';

		$db->close();
	}

	function checkOutOrder() {
		$select_query = "SELECT * FROM order_table";

		$db = getDb();

		$result = $db->query($select_query);

		while ($row = $result->fetch_assoc()) {
			$add_query = "INSERT INTO transaction_table (user_id,
														 order_id)
														 VALUES
														 ('1',
														 '".$row["order_id"]."')";

			$add_result = $db->query($add_query);
		}

		$delete_query = "DELETE FROM order_table";

		$result = $db->query($delete_query);

		$db->close();

		if (!$result) return false;
	}

?>