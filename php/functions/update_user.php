<?php 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

$isUpdating = false;

if (isset($_REQUEST["user_id"]) && $_REQUEST["user_id"] != 0)
	$isUpdating = true;

$id = $_REQUEST["user_id"];
$username = $_REQUEST["username"];
$firstname = $_REQUEST["firstname"];
$lastname = $_REQUEST["lastname"];
$password = $_REQUEST["password"];
$lastname = $_REQUEST["lastname"];
$isAdmin = isset($_REQUEST["isadmin"]) ? 1 : 0;

if ($username == "") {
	header("Location:../../usermaster.php?err");
	exit();
}

if ($isUpdating) {

	$res = User::checkUsername($username);

	if ($res != $id && $res != 0) {
		header("Location:../../usermaster.php?id=$id&err");
		exit();
	}


	$user = User::getUser($id);
	$user->username = $username;
	$user->password = $password;
	$user->firstName = $firstname;
	$user->lastName = $lastname;
	$user->isAdmin = $isAdmin;

	$user->updateUser();
} 
else {

	$res = User::checkUsername($username);
	if ($res != 0) {
		header("Location:../../usermaster.php?err");
		exit();
	}

	$user = new user();
	$user->username = $username;
	$user->password = $password;
	$user->firstName = $firstname;
	$user->lastName = $lastname;
	$user->isAdmin = $isAdmin;

	$user->addToDatabase();
	header("Location:../../users.php?succ");
	session_unset($_SESSION["user"]);
	exit();
}

header("Location:../../usermaster.php?id=$id&succ");
exit();

 ?>