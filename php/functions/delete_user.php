<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

$userId = $_REQUEST["id"];

$db = getDb();

$query = "DELETE FROM user_table WHERE user_id='$userId';";

$result = mysqli_query($db, $query);

mysqli_close($db);

if (!$result) {
	header("Location:../../users.php?err");
	exit();
}

header("Location:../../users.php?succ");
exit();

 ?>