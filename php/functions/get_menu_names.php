<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

$name = $_REQUEST["name"];

$menuId = Product::checkName($name);

echo json_encode($menuId);


?>