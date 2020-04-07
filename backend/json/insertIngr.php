<?php

require_once '../PDOFactory.php';

$obj = new stdClass();
$obj->success = true;
$obj->error = "l'ingredient est déjà créé";

$name = $_POST["description_I"];

$db = PDOFactory::getConnexion();

$reqS = $db->prepare('SELECT idI, description_I FROM INGREDIENT
            WHERE description_I = "'.$name.'"');
$reqS->execute();
$result = $reqS->fetchAll();
if(isset($result)) {
    echo "dedede";
    $obj->success = false;
} else {
    $req = $db->prepare("INSERT INTO `INGREDIENT`(`description_I`) VALUES (\"$name\")");
    $req->execute();
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
