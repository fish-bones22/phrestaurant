<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

class User
{
	public $userId;
	public $username;
	public $password;
	public $firstName;
	public $lastName;
	public $isAdmin;
	public $lastLogTime;
	public $lastLogType;


	public static function checkUser($username, $password) {

		$db = getDb();

		$query = "SELECT `user_id` FROM `user_table` WHERE `user_name` = '$username' AND `user_password` = '$password';";
		$result = mysqli_query($db, $query);

		mysqli_close($db);

		if (!$result)
			return -1;

		while ($row = mysqli_fetch_array($result))
			return $row["user_id"];

	}


	public static function getUser($userId) {

		$db = getDb();

		$query = "SELECT * FROM user_table
			LEFT JOIN dtr_table ON user_table.user_id = dtr_table.user_id
			WHERE user_table.user_id = '$userId' 
			ORDER BY log_id DESC;";

		$result = mysqli_query($db, $query);

		mysqli_close($db);

		if (!$result) 
			return null;

		$user = new User();

		while ($row = mysqli_fetch_array($result)) {

			$user->userId = $userId;
			$user->username = $row["user_name"];
			$user->password = $row["user_password"];
			$user->firstName = $row["user_first_name"];
			$user->lastName = $row["user_last_name"];
			$user->isAdmin = $row["isAdmin"];
			$user->lastLogTime = $row["log_timestamp"];
			$user->lastLogType = $row["log_type"];

			return $user;
		}


	}
}


 ?>