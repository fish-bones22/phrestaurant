<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

$categoryId = $_REQUEST["id"];

$db = getDb();

$query = "DELETE FROM category_table WHERE category_id='$categoryId';";

$result = mysqli_query($db, $query);

mysqli_close($db);

if (!$result) {
	header("Location:../../categories.php?err");
	exit();
}

header("Location:../../categories.php?succ");
exit();

 ?>