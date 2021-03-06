<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

$user = $_REQUEST["username"];
$password = $_REQUEST["password"];

$userId = User::checkUser($user, $password);

if ($userId <= 0) {
	header("Location:../../logtime_verify.php?err");
	exit();
}

$token =  hash('ripemd160', date("YmdHis"));

header("Location:../../logtime.php?id=".$userId."&token=".$token);

?>