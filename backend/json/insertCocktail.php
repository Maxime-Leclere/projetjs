<?php
require_once '../PDOFactory.php';

$obj = new stdClass();
$obj->success = true;
$obj->error = "";

$quantityIng = $_POST['quantityIng'];
$ingList = array();

for ($i=0; $i < $quantityIng; $i++) {
    $ingList[] = $_POST['inglist'+$i];
}
if (sizeof(array_unique($ingList)) != sizeof($ingList)) { // si il y a des doublons
    $obj->success = false;
    $obj->error = "Impossible d'avoir des doublons d'ingrédients";
}

$db = PDOFactory::getConnexion();
