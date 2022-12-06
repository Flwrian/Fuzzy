<?php

namespace App\Covoiturage\Model\Repository;


// Alias pour pouvoir utiliser Conf
use App\Covoiturage\Config\Conf;

use PDO;

class DatabaseConnection {

    private static ?DatabaseConnection $instance = null;
    private PDO $pdo;
    
    public function __construct() {
        $this->pdo = new PDO("mysql:host=".Conf::getHostname().";dbname=".Conf::getDatabase(), Conf::getLogin(), Conf::getPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getPdo() : PDO {
        return static::getInstance()->pdo;
    }

    private static function getInstance() : DatabaseConnection {
        if (is_null(static::$instance))
            // Appel du constructeur
            static::$instance = new DatabaseConnection();
        return static::$instance;
    }
}