<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

$user = $_REQUEST["username"];
$password = $_REQUEST["password"];
$nextpage = $_REQUEST["next_page"];

$user = User::userLogIn($user, $password);

if ($user->isAdmin <= 0) {
	header("Location:../../adminverify.php?page=".$nextpage."&err");
	exit();
}

$token =  hash('ripemd160', date("YmdHi"));

header("Location:../../".$nextpage.".php?token=".$token);

?>