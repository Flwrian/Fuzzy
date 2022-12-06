<?php
require_once __DIR__ . '/../../view/voiture/list.php';
echo "La voiture d'immatriculation : " . $voiture->getImmatriculation() . " a bien été supprimée.";