<?php
require_once '../PDOFactory.php';

$listRecipe = stdClass();

$db = PDOFactory::getConnexion();

$db = PDOFactory::getConnexion();
$req = $db->prepare("SELECT ");
$req->execute();

while(sizeof($data = $req->fetchAll()) != 0) {
    $data
}
