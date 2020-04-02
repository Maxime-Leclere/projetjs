<?php
require_once '../PDOFactory.php';

$listIngrUnit = new stdClass();
$listIngrUnit->list = array();

$db = PDOFactory::getConnexion();

$reqI = $db->prepare("SELECT * FROM INGREDIENT");

$reqU = $db->prepare("SELECT * FROM UNIT");

$reqI->execute();
$reqU->execute();

$dataI = $reqI->fetchAll();
$dataU = $reqU->fetchAll();

if(sizeof($dataI) != 0) {
    for ($i=0; $i < sizeof($dataI); $i++) {
        $listIngrUnit->list[]["ingredient"][] = array($dataI[$i]["idI"], $dataI[$i]["description_I"]);
    }
}

if(sizeof($dataU) != 0) {
    for ($i=0; $i < sizeof($dataU); $i++) {
        $listIngrUnit->list[]["unite"][] = array($dataU[$i]["idU"], $dataU[$i]["description_U"]);
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($listIngrUnit);
