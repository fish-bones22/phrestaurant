<?php 
	require_once '../constants.php';

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