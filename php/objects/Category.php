<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

/**
 * 		
 */
class Category
{
	public $id;
	public $name;


	public static function getCategory($id) {

		$db = getDb();
		$query = "SELECT * FROM category WHERE category_id = '$id'";
		$result = mysqli_query($db, $query);
		$mysqli_close($db);

		if (!$result)
			return null;

		while ($row = mysqli_fetch_array($result)) {
			$category = new Category();
			$category->id = $row["id"];
			$category->name = $row["name"];
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