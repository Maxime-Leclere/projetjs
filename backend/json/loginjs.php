<?php
session_start();

$obj = new stdClass();
$obj->success = false;
$obj->message = 'nom d\'utilisateur ou mot de passe incorrect...';
$found = null;
if (isset($_POST['login'] && isset($_POST['password']) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // php a rempli $__POST[username] et $__POST[password]
    if($login == "momo" && $password == "lolo") {
        $found = true; // trouver en base et ok
    } else {
        $found = false;
    }

    if ($found) {
        $obj->success = true;
        $_SESSION['user'] = 123; // normalement c'est $__POST[username]
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');


echo json_encode($obj);
