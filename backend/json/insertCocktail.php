<?php
require_once '../PDOFactory.php';

$obj = new stdClass();
$obj->success = true;
$obj->error = "Impossible d'avoir des doublons d'ingrédients";

$title = $_POST['title'];
$quantityIng = $_POST['quantityIng'];
$ingList = array();

for ($i=0; $i < $quantityIng; $i++) {
    $ingList[] = $_POST['inglist'.$i];
}

$db = PDOFactory::getConnexion();
$reqS = $db->prepare('SELECT title FROM COCKTAIL WHERE title ="'. $title.'"');
$reqS->execute();
$result = $reqS->fetchAll();

if (sizeof(array_unique($ingList)) != sizeof($ingList)) { // si il y a des doublons
    $obj->success = false;
} if(sizeof($result) != 0) {
    $obj->success = false;
    $obj->error = "Ce titre est déjà utilisé";
} if ($obj->success) {
    $descr = $_POST['description_C'];
    $detail = $_POST['detail'];
    $reqICocktail = $db->prepare("INSERT INTO `COCKTAIL`(`title`, `description_C`, `detail`)
                                VALUES (\"$title\", \"$descr\", \"$detail\")");
    $reqICocktail->execute();
    $listIngUnit = array();
    for ($i=0; $i < $quantityIng; $i++) {
        $listIngUnit[] = array(intval($_POST['inglist'.$i]), intval($_POST['unitList'.$i]),
            intval($_POST['quantity'.$i]));
    }
    var_dump($listIngUnit);
    $reqInsertRecipe = null;
    $reqSId = $db->prepare('SELECT idC FROM COCKTAIL WHERE title ="'. $title.'"');
    $reqSId->execute();
    $resultSId = $reqSId->fetchAll();
    $resultSIdToInt = intval($resultSId[0]['idC']);
    var_dump($resultSId);
    foreach ($listIngUnit as $key => $value) {
        $reqInsertRecipe = $db->prepare("INSERT INTO `COCKTAILINGREDIENTUNIT`
            (`id_C`, `id_I`, `id_U`, `quantity`) VALUES ($resultSIdToInt,
            $listIngUnit[$key][0], $listIngUnit[$key][1], $listIngUnit[$key][2])");
            $reqInsertRecipe->execute();
        var_dump($resultSIdToInt);
        var_dump($listIngUnit[$key][0]);
        var_dump($listIngUnit[$key][1]);
        var_dump($listIngUnit[$key][2]);
    }
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
