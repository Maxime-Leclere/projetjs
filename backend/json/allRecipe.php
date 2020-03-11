<?php
require_once '../PDOFactory.php';

$listRecipe = new stdClass();
$listRecipe->recipe = array();

$db = PDOFactory::getConnexion();

$req = $db->prepare("SELECT * FROM `COCKTAILINGREDIENTUNIT` R, COCKTAIL C,
    INGREDIENT I, UNIT U WHERE id_C = C.idC and id_I = I.idI and id_U = U.idU
    ORDER BY C.idC");

$req->execute();
$data = $req->fetchAll();
if(sizeof($data) != 0) {
    $idCocktail = 1;
    for ($i=0; $i < sizeof($data); $i++) {
        if ($idCocktail  == intval($data[$i]['idC']) || $idInter == 0) {
            $listRecipe->recipe[$idCocktail] = array($data[$i]['idC'], $data[$i]['title'],
                $data[$i]['description_C'], $data[$i]['detail'], $i => array(
                    array(array(
                    $data[$i]['idI'], $data[$i]['description_I']), array(
                    $data[$i]['idU'], $data[$i]['description_U']), $data[$i]['quantity']));
                    echo "yes ".$i." ".$idCocktail;
                print_r($listRecipe->recipe[$idCocktail]['ingredients']);
        } else {
            $idCocktail++;
            $i--;
            echo "no ".$i." ".$idCocktail;

        }

    }
}

// header('Cache-Control: no-cache, must-revalidate');
// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
// header('Content-type: application/json');


echo json_encode($listRecipe);
