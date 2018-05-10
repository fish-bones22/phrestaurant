<?php 

	require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/constants.php';

	function getDb() {

		$db = mysqli_connect(
			AppConstants::$hostname,
			AppConstants::$username, 
			AppConstants::$password, 
			AppConstants::$dbname)
		or die("Connection failed.");

		return $db;

	}
 ?>