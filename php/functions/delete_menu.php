<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

$menuId = $_REQUEST["id"];

$db = getDb();

$query = "DELETE FROM menu_table WHERE menu_id='$menuId';";

$result = mysqli_query($db, $query);

mysqli_close($db);

if (!$result) {
	header("Location:../../menulist.php?err");
	exit();
}

header("Location:../../menulist.php?succ");
exit();

 ?>