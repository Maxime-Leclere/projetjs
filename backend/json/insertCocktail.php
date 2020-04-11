<?php
require_once '../PDOFactory.php';

$obj = new stdClass();
$obj->success = true;
$obj->error = "Impossible d'avoir des doublons d'ingrédients";

$title = $_POST['title'];
$quantityIng = $_POST['quantityIng'];
$ingList = array();

for ($i=0; $i < $quantityIng; $i++) {
    $ingList[] = $_POST['inglist'+$i];
    var_dump ($_POST['inglist'+$i]);

}
$test = 0;
var_dump($_POST['inglist'+$test]);
var_dump( $ingList);

$db = PDOFactory::getConnexion();
$reqS = $db->prepare('SELECT title FROM COCKTAIL WHERE title = ' + $title);
$reqS->execute();
$result = $reqS->fetchAll();

if (sizeof(array_unique($ingList)) != sizeof($ingList)) { // si il y a des doublons
    $obj->success = false;
} if(sizeof($result)) {
    $obj->success = false;
    $obj->error = "Ce titre est déjà utilisé";
} if ($obj->success) {
    $descr = $_POST['description_C'];
    $detail = $_POST['detail'];
    $reqICocktail = $db->prepare("INSERT INTO `COCKTAIL`(`title`, `description_C`, `detail`)
                                VALUES (\"$title\", \"$descr\", \"$detail\")");
    $reqICocktail->execute();
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($obj);
