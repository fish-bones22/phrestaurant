<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

/**
 * 	
 */
class Log
{
	public $id;
	public $name;
	public $login;
	public $logout;
	public $date;

	public static function getLogs() {

		$db = getDb();
		$query = "SELECT *, 
		DATE_FORMAT(dtr_table.log_timestamp, '%h:%i %p') as formatted_time, 
		DATE_FORMAT(dtr_table.log_timestamp, '%b %d, %Y') as formatted_date
		FROM dtr_table 
		WHERE log_type = 1;";

		$result = mysqli_query($db, $query);

		if (!$result) 
			return null;

		$users = User::getAllUsers();

		$logs = [];

		while ($row = mysqli_fetch_array($result)) {

			$id = $row['log_id'];
			$user = $row['user_id'];

			if (!array_key_exists($user, $users)) {
				continue;
			}

			$log = new Log();

			$log->id = $row['log_id'];
			$log->name = $users[$user]->firstName." ".$users[$user]->lastName;
			$log->date = $row['formatted_date'];
			$log->login = $row['formatted_time'];

			$query2 = "SELECT *, 
			DATE_FORMAT(dtr_table.log_timestamp, '%h:%i %p') as formatted_time, 
			DATE_FORMAT(dtr_table.log_timestamp, '%b %d, %Y') as formatted_date
			FROM dtr_table 
			WHERE log_type = 0
			AND user_id = $user
			AND log_id > $id
			ORDER BY log_id
			LIMIT 1;";

			$result2 = mysqli_query($db, $query2);

			if ($result2) {
				while ($row2 = mysqli_fetch_array($result2)) {
					if ($row2['formatted_date'] == $log->date) {
						$log->logout = $row2['formatted_time'];	
					}
					break;
				}
			}

			$logs[] = $log;

		}

		mysqli_close($db);

		return $logs;

	}
}

 ?>