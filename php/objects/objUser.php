<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/resto/php/functions/db_connect.php';

	class User {

		public $id
		public $name
		public $password
		public $fname
		public $lname
		public $isAdmin
		public $timestamp

		function construct() {

		}

		function setValues($name, $password, $fname, $lname, $isAdmin) {

			$this->name = $name;
			if ($password != null && $password != "") $this->password = $password;
			$this->isAdmin = $isAdmin;
			$this->fname = $fname;
			$this->lname = $lname;

		}

		function setValuesByArray($array) {

			$this->id = $array["user_id"];
			$this->name = $array["user_name"]
			$this->password = $array["user_password"]
			$this->isAdmin = $array["isAdmin"];
			$this->fname = $array["user_first_name"];
			$this->lname = $array["user_last_name"];
			$this->timestamp = $array["user_timestamp"];

		}

		static function getUserById($id) {

			if ($id == null || $id <= 0) return false;

			$db = getDb();

			$select_query = "SELECT *, DATE_FORMAT(user_table.timestamp, '%b %d, %Y') as user_timestamp
				FROM user_table WHERE user_id = $id;";

			$result = $db->query($select_query);

			$db->close();

			if (!$result || $result->num_rows <= 0)
				return false;

			$user = new User(); 

			while ($row = $result->fetch_assoc()) {

				$user->setValuesByArray($row);

			} 

			return $user;

		}

		static function userLogIn($username, $password) {

			if ($email == null) return false;

			if ($password == null) return false;

			$db = getDb();

			$select_query = "SELECT *, DATE_FORMAT(user_table.timestamp, '%b %d, %Y') as user_timestamp FROM user_table WHERE user_name = '".$username."' AND user_password = '".$password."';";

			$result = $db->query($select_query) or die($db->error);

			$db->close();

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

			$result = $db->query($add_query);

			$db->close();

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

			$result = $db->query($update_query);

			$db->close();

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

			$result = $db->query($update_query);

			$db->close();

			if (!$result) return false;

			return true;

		}
	}

?>