<?php

require_once '../PDOFactory.php';

$name = $_POST["description_I"];

$db = PDOFactory::getConnexion();
$req = $db->prepare("INSERT INTO `INGREDIENT`(`description_I`) VALUES (\"$name\")");
$req->execute();

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
