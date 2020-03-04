<?php
require_once '../PDOFactory.php';
session_start();

$obj = new stdClass();
$obj->success = false;
$obj->error = array();

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $db = PDOFactory::getConnexion();
    $req = $db->prepare('SELECT id, login, password FROM utilisateur
                WHERE login = "'.$login.'"');
    $req->execute();
    $result = $req->fetchAll();

    if (strlen($login) > 10) {
        $obj->error["#message_login"] = "le login ne peut avoir que 10 caractères";
    } if (strlen($password) < 8) {
        $obj->error["#message_password"] = "le password doit avoir plus de 8 caractères";
    } if(isset($result)) {
        $obj->error["#message_login"] = "le login est déjà utilisé";
    }

    if (!sizeof($obj->error)) {
        // on insere dans la base de donné si il n'y a pas d'erreur
        $reqI = $db->prepare("INSERT INTO `UTILISATEUR`(`login`, `password`)
                            VALUES (\"$login\", \"$password\")");
        $reqI->execute();
        $obj->success = true;
        $_SESSION['user'] = $login;
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($obj);
