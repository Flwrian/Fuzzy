<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class Voiture {


    private string $immatriculation;
    private string $marque;
    private int $nbSieges;
    private string $couleur;

    public function getMarque(){
        return $this->marque;
    }

    public function setMarque(string $marque) {
        $this->marque = $marque;
    }

    public function __construct(
        $immatriculation,
        $marque, 
        $couleur, 
        $nbSieges
    )
    {
          $this->immatriculation = $immatriculation;
          $this->marque = $marque;
          $this->couleur = $couleur;
          $this->nbSieges = $nbSieges;
    }

    public function __toString() : string {
        return "Voiture immatriculé: $this->immatriculation de marque $this->marque (couleur $this->couleur, $this->nbSieges places)";
    }

    public function getCouleur() :string {
        return $this->couleur;
    }
    
    public function getImmatriculation() : string {
        return $this->immatriculation;
    }

    public function getNbSieges() : string {
        return $this->nbSieges;
    }

    public function setCouleur(string $couleur){
        $this->couleur = $couleur;
    }

    public function setImmatriculation(string $immatriculation){
        $this->immatriculation = substr($immatriculation, 8);
    }

    public function setNbSieges(int $nbSieges){
        $this->nbSieges = $nbSieges;
    }

}