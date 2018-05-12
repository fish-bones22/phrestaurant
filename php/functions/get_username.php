<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

$user = $_REQUEST["uname"];

$userId = User::checkUsername($user);

echo json_encode($userId);


?>