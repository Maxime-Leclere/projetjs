<?php
namespace backend;

class PDOFactory {
    static function getConnexion() {
        return new \PDO('mysql:host=mysql-projetjs.alwaysdata.net;dbname=projetjs_database;',
            'projetjs', 'Azertyuiop1999');
    }
}
