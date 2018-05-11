<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

class User
{
	public $id;
	public $username;
	public $password;
	public $firstName;
	public $lastName;
	public $isAdmin;
	public $lastLogTime;
	public $lastLogType;


	function setValues($name, $password, $fname, $lname, $isAdmin) {

		$this->username = $name;
		if ($password != null && $password != "") $this->password = $password;
		$this->isAdmin = $isAdmin;
		$this->firstName = $fname;
		$this->lastName = $lname;

	}

	function setValuesByArray($array) {

		$this->id = $array["user_id"];
		$this->username = $array["user_name"];
		$this->password = $array["user_password"];
		$this->isAdmin = $array["isAdmin"];
		$this->firstName = $array["user_first_name"];
		$this->lastName = $array["user_last_name"];
		$this->lastLogTime = $array["formatted_time"];
		$this->lastLogType = $array["log_type"];

	}


	static function getUser($id) {

		if ($id == null || $id <= 0) return null;

		$db = getDb();

		$select_query = "SELECT *, DATE_FORMAT(dtr_table.log_timestamp, '%h:%m %p, %b %d, %Y') as formatted_time
			FROM user_table 
			LEFT JOIN dtr_table ON user_table.user_id = dtr_table.user_id
			WHERE user_table.user_id = $id
			ORDER BY dtr_table.log_id DESC;";

		$result = mysqli_query($db, $select_query);

		mysqli_close($db);

		if (!$result || $result->num_rows <= 0)
			return null;

		$user = new User(); 

		while ($row = $result->fetch_assoc()) {

			$user->setValuesByArray($row);
			break;
		} 

		return $user;

	}


	static function userLogIn($username, $password) {

		if ($password == null) return false;

		$db = getDb();

		$select_query = "SELECT *, DATE_FORMAT(user_table.timestamp, '%b %d, %Y') as user_timestamp FROM user_table WHERE user_name = '".$username."' AND user_password = '".$password."';";

		$result = mysqli_query($db, $select_query);

		mysqli_close($db);

		if (!$result || $result->num_rows <= 0)
			return false;

		$user = new User(); 

		while ($row = $result->fetch_assoc()) {

			$user->setValuesByArray($row);

		}

		return $user;

	}

	function registerToDatabase() {
		
		// If user is already defined. Use update instead.
		if ($this->id != null && $this->id != 0) return false;

		$db = getDb();

		$add_query = "INSERT INTO user_table 
		(user_name, 
		 user_password,	
		 isAdmin,	
		 user_first_name,
		 user_last_name) 
		VALUES 
		('$this->name', 
		 '$this->password',	
		 '$this->isAdmin',	
		 '$this->fname',	
		 '$this->lname');";

		$result = mysqli_query($db, $select_query);

		mysqli_close($db);

		if (!$result) return false;

		$user_name = $this->name;
		$this->id = User::getUserByUserName($username)->id;

		return true;

	}


	function userUpdate() {
		
		// If user is not defined. Use register instead.
		if ($this->id == null || $this->id == 0) return false;

		$db = getDb();

		$update_query = "UPDATE user_table SET
		user_name = '$this->name',
		user_first_name = '$this->fname',
		user_last_name = '$this->lname' WHERE user_id = '$this->id';";

		$result = mysqli_query($db, $update_query);

		mysqli_close($db);

		if (!$result) return false;

		return true;

	}


	function changePassword($newpass) {
		
		// If user is not defined. Use register instead.
		if ($this->id == null || $this->id == 0) return false;

		$db = getDb();

		$update_query = "UPDATE user_table SET
		user_password = $newpass
		WHERE user_id = '$this->id';";

		$result = mysqli_query($db, $update_query);

		mysqli_close($db);

		if (!$result) return false;

		return true;

	}


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