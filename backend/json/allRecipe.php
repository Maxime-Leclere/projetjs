<?php
require_once '../PDOFactory.php';

$listRecipe = stdClass();
$listRecipe->recipe = array();

$db = PDOFactory::getConnexion();

$req = $db->prepare("SELECT * FROM `COCKTAILINGREDIENTUNIT` R, COCKTAIL C,
    INGREDIENT I, UNIT U WHERE id_C = C.id and id_I = I.id and id_U = U.id
    ORDER BY C.id");

$req->execute();
$data = $req->fetchAll();

if(sizeof($data) != 0) {
    $listInter = array();
    $idInter = 0;
    for ($i=0; $i < sizeof($data); $i++) {
        $idInter = $data[$i]['idC'];
        if ($idInter  == $idInter-1) {

        } else {

        }
        $listInter[] = array($data[$i]['idC'], $data[$i]['title'],
            $data[$i]['description_C'], $data[$i]['detail'], $data[$i]['idI'],
            $data[$i]['description_I'], $data[$i]['idU'], $data[$i]['description_U']);

    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($listRecipe);
