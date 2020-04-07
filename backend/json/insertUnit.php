<?php

require_once '../PDOFactory.php';

$obj = new stdClass();
$obj->success = true;
$obj->error = "l'unité est déjà créée";

$name = $_POST["description_U"];


$db = PDOFactory::getConnexion();

$reqS = $db->prepare('SELECT idU, description_U FROM UNIT
            WHERE description_U = "'.$name.'"');
$reqS->execute();
$result = $reqS->fetchAll();
if(isset($result)) {
    $obj->success = false;
} else {
    $req = $db->prepare("INSERT INTO `UNIT`(`description_U`) VALUES (\"$name\")");
    $req->execute();
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
