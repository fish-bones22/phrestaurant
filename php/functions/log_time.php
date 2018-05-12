<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';

$user = $_REQUEST["user"];
$logType = !$_REQUEST["log_type"];


$db = getDb();
$query = "INSERT INTO dtr_table (user_id, log_type) VALUES ('$user', '$logType');";
$result = mysqli_query($db, $query);
mysqli_close($db);

header("Location:../../logtime_verify.php");
exit();

?>