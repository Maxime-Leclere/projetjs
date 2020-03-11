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
        $listRecipe->recipe[$idCocktail] = array($data[$i]['idC'], $data[$i]['title'],
            $data[$i]['description_C'], $data[$i]['detail'], "ingredients" => array());
        if ($idCocktail  === intval($data[$i]['idC'])) {

                // array_push($listRecipe->recipe[$idCocktail]['ingredients'],
                $listRecipe->recipe[$idCocktail]['ingredients'][] =
                    array(array(
                    $data[$i]['idI'], $data[$i]['description_I']), array(
                    $data[$i]['idU'], $data[$i]['description_U']), $data[$i]['quantity']);
                    echo "yes ".$data[$i]['idC']." ".$idCocktail;
                print_r($listRecipe->recipe[$idCocktail]['ingredients']);
                echo "\n";
                print_r($listRecipe->recipe);
                echo "\n";
        } else {
            $idCocktail++;
            $i--;
            echo "no ".$data[$i]['idC']." ".$idCocktail;

        }

    }
}

// header('Cache-Control: no-cache, must-revalidate');
// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
// header('Content-type: application/json');


echo json_encode($listRecipe);
