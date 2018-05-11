<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/resto/php/functions/db_connect.php';

	class Product {
		public $id;
		public $name;
		public $price;
		public $quantity;
		public $category;
		public $timestamp;

		function __construct() {
		}

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
			$this->timestamp = $menu_array["menu_timestamp"];
		}

		function addToDatabase() {
			// If product is already defined. Use update instead.
			if ($this->id != null && $this->id != 0) return false;

			if ($this->name == null || $this->name == "") return false;
			if ($this->price == null || $this->price == "") return false;
			if ($this->quantity == null || $this->quantity == "") return false;
			if ($this->category == null || $this->category == "") return false;

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

			$result = $db->query($add_query);

			$db->close();

			if (!$result) return false;

			return true;

		}

		function updateProduct()
		{
			// If product is not yet defined. Use add instead.
			if ($this->id == null || $this->id == 0) return false;

			// Validations
			if ($this->name == null || $this->name == "") 									return false;
			if ($this->price == null || $this->price == "") 		return false;
			if ($this->quantity == null || $this->quantity == 0) 									return false;
			if ($this->category == null || $this->category == "") 	return false;

			$db = getDb();

			$update_query = "UPDATE menu_table SET
			menu_name = '$this->name', 
			menu_price = '$this->price',	
			menu_quantity = '$this->quantity',	
			category_id = '$this->category'
			WHERE menu_id = '$this->id';";
			echo $update_query;
			$result = $db->query($update_query);

			$db->close();

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

			$result = $db->query($update_query);

			$db->close();

			if (!$result) return false;

			return true;

		}
		
		function getAllMenu() {

			$db = getDb();

			$select_query = "SELECT * FROM menu_table ORDER BY category_id";

			$result = $db->query($select_query);

			$db->close();

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
	}
?>