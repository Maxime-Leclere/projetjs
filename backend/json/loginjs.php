<?php
use PDOFactory;
session_start();

$obj = new stdClass();
$obj->success = false;
$obj->message = 'nom d\'utilisateur ou mot de passe incorrect...';
$found = null;
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $db = PDOFactory::getConnexion();
    $req = $db->prepare('SELECT id, login, password FROM utilisateur
                WHERE login = "$login" AND password = "$password"')
    $req->execute();
    $result = $req->fetchAll();

    if (sizeof($result)) {
        $obj->success = true;
        $_SESSION['user'] = $login;
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($obj);
