<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/resto/php/functions/db_connect.php';

	$conn = connectToDb("resto_db");

	$select_query = "SELECT * FROM menu_table WHERE "





	$result = fetch_assoc();

	echo json_encode($result)

?>