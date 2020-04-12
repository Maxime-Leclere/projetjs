<?php
require_once '../PDOFactory.php';

$listCocktail = new stdClass();
$listCocktail->cocktail = array();

$db = PDOFactory::getConnexion();

$req = $db->prepare("SELECT C.idC, C.title, C.description_C, C.detail
                    FROM `COCKTAILINGREDIENTUNIT` R, COCKTAIL C
                    WHERE id_C = C.idC ORDER BY C.idC");

$req->execute();
$data = $req->fetchAll();
if(sizeof($data) != 0) {
    $idCocktail = 1;
    $ingredients = array();
    for ($i=0; $i < sizeof($data); $i++) {
        if ($data[$i]['idC'] == $data[$i-1]['idC']){
            continue;
        }
        $listCocktail->cocktail[/*$idCocktail*/] = array($data[$i]['idC'], $data[$i]['title'],
            $data[$i]['description_C'], $data[$i]['detail']);//, "ingredients" => array());
    //     if ($idCocktail  === intval($data[$i]['idC'])) {
    //
    //             // array_push($listCocktail->cocktail[$idCocktail]['ingredients'],
    //         $ingredients[] = array(array(
    //         $data[$i]['idI'], $data[$i]['description_I']), array(
    //         $data[$i]['idU'], $data[$i]['description_U']), $data[$i]['quantity']);
    //
    //     } else {
    //         foreach ($ingredients as $key => $value) {
    //             // $listCocktail->cocktail[$idCocktail]['ingredients'][] = $value;
    //             array_push($listCocktail->cocktail[$idCocktail]['ingredients'], $value);
    //         }
    //         $ingredients = array();
    //         $idCocktail++;
    //         $i--;
    //     }
    //
    }
    // foreach ($ingredients as $key => $value) {
    //     // $listCocktail->cocktail[$idCocktail]['ingredients'][] = $value;
    //     array_push($listCocktail->cocktail[$idCocktail]['ingredients'], $value);
    // }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($listCocktail);
