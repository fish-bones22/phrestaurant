<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Category.php';


if (isset($_REQUEST["categoryId"]) && isset($_REQUEST["categoryName"])) {

	$categoryIds = $_REQUEST["categoryId"];
	$categoryNames = $_REQUEST["categoryName"];

	$i = 0;
	for ($i = 0; $i < sizeof($categoryIds); $i++) {

		$res = false;
		if (trim($categoryNames[$i], " ") != "") {	
			$category = Category::getCategory($categoryIds[$i]);
			$category->name = $categoryNames[$i];
			$res = $category->updateCategory();
		}

		if (!$res) {
			header("Location:../../categories.php?err");
			exit();
		}

	}

}

if (isset($_REQUEST["new_category"])) {

	$newCategory = $_REQUEST["new_category"];

	if (empty($newCategory)) {
		header("Location:../../categories.php?err");
		exit();
	}

	$res = false;
	if (trim($newCategory, " ") != "") {
		$category = new Category();
		$category->name = $newCategory;
		$res = $category->addToDb();
	}

	if (!$res) {
		header("Location:../../categories.php?err");
		exit();
	}

}

header("Location:../../categories.php?succ");

?>