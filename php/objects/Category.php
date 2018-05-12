<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

/**
 * 		
 */
class Category
{
	public $id;
	public $name;

	public function addToDb() {

		$db = getDb();
		$query = "INSERT INTO category_table (category_name) VALUES ('$this->name');";
		$result = mysqli_query($db, $query);
		mysqli_close($db);

		if (!$result)
			return false;

		return true;

	}


	public function updateCategory() {

		$db = getDb();
		$query = "UPDATE category_table SET category_name='$this->name'
		WHERE category_id = '$this->id';";
		$result = mysqli_query($db, $query);
		mysqli_close($db);

		if (!$result)
			return false;

		return true;

	}


	public static function getCategory($id) {

		$db = getDb();
		$query = "SELECT * FROM category_table WHERE category_id = '$id'";
		$result = mysqli_query($db, $query);
		mysqli_close($db);

		if (!$result)
			return null;

		while ($row = mysqli_fetch_array($result)) {
			$category = new Category();
			$category->id = $row["category_id"];
			$category->name = $row["category_name"];
			return $category;
		}

	}


	public static function getCategories() {

		$db = getDb();
		$query = "SELECT * FROM category_table";
		$result = mysqli_query($db, $query);
		mysqli_close($db);

		if (!$result)
			return null;

		$categories = [];

		while ($row = mysqli_fetch_array($result)) {
			$category = new Category();
			$category->id = $row["category_id"];
			$category->name = $row["category_name"];


			$categories[] = $category;
		}

		return $categories;

	}
}

 ?>