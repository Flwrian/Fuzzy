<?php

use App\Covoiturage\Lib\Psr4AutoloaderClass;
require_once __DIR__ . '/../Lib/Psr4AutoloaderClass.php';

// instantiate the loader
$loader = new Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Covoiturage', __DIR__ . '/../../src/');
// register the autoloader
$loader->register();

use App\Covoiturage\Controller\ControllerVoiture;

// On recupère l'action passée dans l'URL
if(!isset($_GET['action'])){
    // Default action
    $action = "readAll";
}
else{
    // Action passée dans l'URL
    $action = $_GET['action'];
}

// We check if the action passed in the URL is callable in ControllerVoiture
if(is_callable(array(ControllerVoiture::class, $action))){
    // Appel de la méthode statique $action de ControllerVoiture
    ControllerVoiture::$action();
}
else{
    // We call the error method of ControllerVoiture because the action is not valid
    ControllerVoiture::error("cette action n'existe pas");
}
?>