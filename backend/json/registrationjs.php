<?php
session_start();

$obj = new stdClass();
$obj->success = false;
$obj->error = array();

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (strlen($login) > 10) {
        $obj->error["#message_login"] = "le login ne peut avoir que 10 caractères";
    } if (strlen($password) < 8) {
        $obj->error["#message_password"] = "le password doit avoir plus de 8 caractères";
    }
    // if(/* on verifie si le login est dans la base de donnée*/) {
    //     $obj->error["#message_login"] = "le login est déjà utilisé";
    // }

    if (isset($obj->error)) {
        // on insere dans la base de donné si il n'y a pas d'erreur
        $obj->success = true;
        $_SESSION['user'] = 123; // normalement c'est $__POST[username]
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($obj);
