<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';
	

	if (!isset($_REQUEST['action'])) {
		$action = "showOrder";
	} else if (isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
	}

	if ($action == "addUpdate") {
		addUpdateOrder();
	} elseif ($action == "deleteItem") {
		deleteOneOrder();
	} elseif ($action == "showOrder") {
		showOrderList();
	} elseif ($action == "checkOutLogin") {
		checkOutLogin();
	} elseif ($action == "quantityCheck") {
		checkQuantity();
	} elseif ($action == "deductQuantity") {
		deductQuantity();
	}

	function addUpdateOrder() {

		$id = $_REQUEST['id'];
		$result = false;

		$db = getDb();

		// Check if menu is already in orders
		$select_query = "SELECT * FROM order_table WHERE menu_id = '$id'";
		$select_result = mysqli_query($db, $select_query);

		// Get Menu details
		$select_query = "SELECT * FROM menu_table WHERE menu_id = '$id'";
		$select_menu_result = $db->query($select_query);
		$availableQty = $select_menu_result->fetch_assoc()['menu_quantity'];
		
		// If newly added
		if ($select_result->num_rows <= 0) {


			// Get new Order ID
			$select_order = "SELECT * FROM transaction_table ORDER BY order_id DESC";
			$order_result = $db->query($select_order);
			$order = $order_result->fetch_assoc();

			if (!$order_result) {
				$order_id = 1;
			} else {
				$order_id = $order["order_id"] + 1; 
			}

			if ($availableQty >= 1) {

				$add_query = "INSERT INTO order_table (order_id, menu_id, order_quantity)
				VALUES ('$order_id', '$id', '1')";

				$result = $db->query($add_query);

			}

		} else {

			$currentQuantity = $select_result->fetch_assoc()["order_quantity"];
			$quantity = $currentQuantity + 1;

			if ($availableQty >= $quantity) {

				$update_query = "UPDATE order_table SET order_quantity = '$quantity'
				WHERE menu_id = '$id'";

				$result = $db->query($update_query);

			}
		}

		mysqli_close($db);
		echo json_encode($result);
	}


	function deleteOneOrder() {
		
		$orderid = $_REQUEST['orderid'];

		$delete_query = "DELETE FROM order_table WHERE table_order_id = '$orderid'";

		$db = getDb();

		$result = $db->query($delete_query);

		$db->close();

		if (!$result) return false;
	}


	function deductQuantity() {
		
		$id = $_REQUEST['orderid'];

		$select_query = "SELECT order_quantity FROM order_table WHERE table_order_id = '$id'";

		$delete_query = "UPDATE order_table SET order_quantity=order_quantity-1 WHERE table_order_id = '$id' AND order_quantity>0";

		$db = getDb();

		$result = $db->query($select_query);

		if ($result) {

			$row = $result->fetch_assoc();

			if ($row['order_quantity'] == 1) {
				
				deleteOneOrder();

			} else {

				$result = $db->query($delete_query);

			}

			$db->close();
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
		$db->close();
	}

	function showOrderList() {

		$select_query = "SELECT * FROM order_table 
		INNER JOIN menu_table ON order_table.menu_id = menu_table.menu_id";

		$db = getDb();

		$result = $db->query($select_query);

		$arr = [];

		if ($result)
	    while($row = $result->fetch_assoc()) {
	    	$arr[] = $row;
		}
	    echo json_encode($arr);
		$db->close();

	}

	function checkOutLogin() {

		if (isset($_REQUEST['user'])) {
		$user = $_REQUEST['user'];
		}
		if (isset($_REQUEST['pass'])) {
		$pass = $_REQUEST['pass'];
		}

		$db = getDb();

		$select_query = "SELECT * FROM user_table WHERE user_name = '".$user."'
												AND user_password = '".$pass."'";

		$result = $db->query($select_query);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			if (checkOutOrder($row["user_id"])) {
				echo $row["user_first_name"]." ".$row["user_last_name"];
				return true;
			}
			else {
				return false;
			}
		}

		return false;
	}

	function checkQuantity() {
		$qid = $_REQUEST['id'];

		$db = getDb();

		$select_query = "SELECT * FROM order_table 
						 WHERE menu_id = '".$qid."'";

		$result = $db->query($select_query);

		$row = $result->fetch_assoc();

		$db->close();

		if (!$result) return false;

		//return $row["order_quantity"];
		//return 1;
		echo $row["order_quantity"];
	}

	function checkOutOrder($id) {
		
		$uid = $id;

		$select_query = "SELECT * FROM order_table
		INNER JOIN menu_table ON order_table.menu_id = menu_table.menu_id";

		$select_user = "SELECT * FROM user_table WHERE user_id = '".$uid."'";

		$db = getDb();

		$user_result = $db->query($user_result);
		$user = $user_result->fetch_assoc();
		$userName = $user["user_first_name"]." ".$user["$user_last_name"];

		$result = $db->query($select_query);

		while ($row = $result->fetch_assoc()) {
			$add_query = "INSERT INTO transaction_table (user_id,
														 user_Name,
														 order_id,
														 menu_id,
														 menu_Name)
														 VALUES
														 ('".$uid."',
														 '".$userName."',
														 '".$row["order_id"]."',
														 '".$row["menu_id"]."'),
														 '".$row["menu_name"]."'";

			$add_result = $db->query($add_query);

			$update_query = "UPDATE menu_table SET 
							 menu_quantity = menu_quantity-'".$row["order_quantity"]."'
							 WHERE menu_id = '".$row["menu_id"]."'";

			$update_result = $db->query($update_query);
		}


		$delete_query = "DELETE FROM order_table";

		$result = $db->query($delete_query);

		$db->close();

		if (!$result) return false;

		return true;
	}

?>