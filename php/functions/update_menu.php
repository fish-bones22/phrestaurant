<?php 
session_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

$isUpdating = false;

if (isset($_REQUEST["menu_id"]) && $_REQUEST["menu_id"] != 0)
	$isUpdating = true;

$menuId = $_REQUEST["menu_id"];
$name = $_REQUEST["menu_name"];
$category = $_REQUEST["menu_category"];
$price = $_REQUEST["menu_price"];
$quantity = $_REQUEST["menu_quantity"];
$token = $_REQUEST["token"];

if ($name == "") {
	header("Location:../../menumaster.php?err");
	exit();
}

$result = false;

// if ($category == "" || $category == 0) {
// 	header("Location:../../menumaster.php?err");
// 	exit();
// }

if ($isUpdating) {

	$res = Product::checkName($name);
	if ($res != $menuId && $res != 0) {
		header("Location:../../menumaster.php?id=$menuId&err");
		exit();
	}

	$product = Product::getMenu($menuId);
	$product->name = $name;
	$product->category = $category;
	$product->price = $price;
	$product->quantity = $quantity;

	$result = $product->updateProduct();

	if ($result) {
		header("Location:../../menumaster.php?id=$menuId&token=$token&succ");
		exit();
	} else {
		header("Location:../../menumaster.php?id=$menuId&token=$token&err");
		exit();
	}
} 
else {

	$res = Product::checkName($name);
	if ($res != 0) {
		header("Location:../../menumaster.php?token=$token&err");
		exit();
	}

	$product = new Product();
	$product->name = $name;
	$product->category = $category;
	$product->price = $price;
	$product->quantity = $quantity;

	$result = $product->addToDatabase();

	session_unset($_SESSION["menu"]);
	if ($result) {
		header("Location:../../menulist.php?token=$token&succ");
		exit();
	} else {
		header("Location:../../menulist.php?token=$token&err");
		exit();
	}
}

 ?>