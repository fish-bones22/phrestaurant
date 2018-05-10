<?php 

require_once '../functions/db_connect.php';

class User
{
	public $userId;
	public $userName;
	public $passWord;
	public $firstName;
	public $lastName;
	public $isAdmin;


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
}


 ?>