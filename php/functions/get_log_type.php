<?php

require_once 'db_connect.php';

function getLogType($user) {

	$query = "SELECT `log_type` FROM `dtr_table` WHERE `user_id` = '$user' ORDER BY `log_id` DESC;";

	$db = getDb();
	$result = mysqli_query($db, $query);

	mysqli_close($db);

	if ($result) {

		while ($row = mysqli_fetch_array($result)){
			return $row;
		}

	}
}

?>