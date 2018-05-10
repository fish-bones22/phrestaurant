<?php

require_once 'db_connect.php';

function checkUser($username, $password) {

	$db = getDb();

	$query = "SELECT `user_id` FROM `user_table` WHERE `user_name` = '$username' AND `user_password` = '$password';";
	$result = mysqli_query($db, $query);

	mysqli_close($db);

	if (!$result)
		return -1;

	while ($row = mysqli_fetch_array($result))
		return $row;

}

?>