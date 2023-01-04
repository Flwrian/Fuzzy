<?php

use App\Covoiturage\Controller\ControllerPanier;
use App\Covoiturage\Lib\Psr4AutoloaderClass;
require_once __DIR__ . '/../Lib/Psr4AutoloaderClass.php';
// instantiate the loader
$loader = new Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Covoiturage', __DIR__ . '/../../src/');
// register the autoloader
$loader->register();



use App\Covoiturage\Model\Repository\ArticleRepository;
use App\Covoiturage\Controller\ControllerArticle;
use App\Covoiturage\Controller\ControllerUser;

/* On start la session */
session_start();

ini_set('display_errors', 'on');



// On recupère l'action passée dans l'URL
if(!isset($_GET['action'])){
    // Default action
    $action = "readAll";
}
else{
    // Action passée dans l'URL
    $action = $_GET['action'];
}

// We check if the action passed in the URL is callable in ControllerArticle
if(is_callable(array(ControllerArticle::class, $action))){
    // We call the action
    ControllerArticle::$action();
}
// We check if the action passed in the URL is callable in ControllerUser
else if (is_callable(array(ControllerUser::class, $action))){
    // We call the action
    ControllerUser::$action();
}
else if(is_callable(array(ControllerPanier::class,$action))){
    ControllerPanier::$action();
}
else{
    // We call the error method of ControllerArticle because the action is not valid
    ControllerArticle::error("Action non valide");
}
?>
