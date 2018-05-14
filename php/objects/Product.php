<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

	class Product {

		public $id;
		public $name;
		public $price;
		public $quantity;
		public $category;
		public $categoryName;
		public $timestamp;

		function setValues($name, $price, $quantity, $category) {
			$this->name = $name;
			$this->price = $price;
			$this->quantity = $quantity;
			$this->category = $category;
		}

		function setValuesByArray($menu_array) {
			$this->id = $menu_array["menu_id"];
			$this->name = $menu_array["menu_name"];
			$this->price = $menu_array["menu_price"];
			$this->quantity = $menu_array["menu_quantity"];
			$this->category = $menu_array["category_id"];
			$this->categoryName = $menu_array["category_name"];
			$this->timestamp = $menu_array["menu_timestamp"];
		}

		function addToDatabase() {
			// If product is already defined. Use update instead.
			if ($this->id != null && $this->id != 0) return false;

			if ($this->name == null || $this->name == "") return false;
			if ($this->price == null || $this->price == "") return false;
			if ($this->quantity == null || $this->quantity == "") return false;

			$db = getDb();

			$add_query = "INSERT INTO menu_table
			(menu_name,
			menu_price,
			menu_quantity,
			category_id) 
			VALUES
			('$this->name',
			'$this->price',
			'$this->quantity',
			'$this->category')";

			$result = mysqli_query($db, $add_query);

			mysqli_close($db);

			if (!$result) return false;

			return true;

		}

		function updateProduct()
		{
			// If product is not yet defined. Use add instead.
			if ($this->id == null || $this->id == 0) 				return false;

			// Validations
			if ($this->name == null || $this->name == "") 			return false;
			if ($this->price == null || $this->price == "") 		return false;
			if ($this->quantity == null) 							return false;

			$db = getDb();

			$update_query = "UPDATE menu_table SET
			menu_name = '$this->name', 
			menu_price = '$this->price',	
			menu_quantity = '$this->quantity',	
			category_id = '$this->category'
			WHERE menu_id = '$this->id';";

			$result = mysqli_query($db, $update_query);

			mysqli_close($db);

			if (!$result) return false;

			return true;

		}

		function updateQuantity($newQuantity) {
			// If menu is not defined. 
			if ($this->id == null || $this->id == 0) return false;

			$db = getDb();

			$update_query = "UPDATE menu_table SET
			 menu_quantity = $newQuantity
			 WHERE menu_id = '$this->id';";

			$result = mysqli_query($db, $update_query);

			mysqli_close($db);

			if (!$result) return false;

			return true;

		}
		
		function getAllMenu() {

			$db = getDb();

			$select_query = "SELECT * FROM menu_table 
			LEFT JOIN category_table ON menu_table.category_id = category_table.category_id
			ORDER BY menu_table.category_id";

			$result = mysqli_query($db, $select_query);

			mysqli_close($db);

			if ($result->num_rows <= 0) return false;

			$prod_array = range(1, $result->num_rows);

			$index = 0;
			while ($row = $result->fetch_assoc()) {
				$prod = new Product();
				$prod->setValuesByArray($row);
				$prod_array[$index] = $prod;
				$index++;
			}

			return $prod_array;

		}
		

		function getMenu($id) {

			$db = getDb();

			$select_query = "SELECT * FROM menu_table
			LEFT JOIN category_table ON menu_table.category_id = category_table.category_id
			WHERE menu_id = '$id';";

			$result = mysqli_query($db, $select_query);

			mysqli_close($db);

			if ($result->num_rows <= 0) return false;

			while ($row = mysqli_fetch_array($result)) {
				$prod = new Product();
				$prod->setValuesByArray($row);
				return $prod;
			}

		}
	}
?>