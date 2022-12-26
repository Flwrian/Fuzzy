<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class Article {


    private string|null $id;
    private string $nom;
    private string $marque;
    private string $prixBatk;

    public function __construct(
        string|null $id,
        string $nom,
        string $marque,
        string $prixBatk
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->marque = $marque;
        $this->prixBatk = $prixBatk;
    }

    public function __toString() : string {
        return "Article{id=$this->id, nom=$this->nom, marque=$this->marque, prixBatk=$this->prixBatk}";

    }

    public function getId() : string|null {
        return $this->id;
    }
    
    public function getNom() : string {
        return $this->nom;
    }

    public function getMarque() : string {
        return $this->marque;
    }

    public function getPrixBatk() : string {
        return $this->prixBatk;
    }

    public function setId(string $id) : void {
        $this->id = $id;
    }

    public function setNom(string $nom) : void {
        $this->nom = $nom;
    }

    public function setMarque(string $marque) : void {
        $this->marque = $marque;
    }

    public function setPrixBatk(string $prixBatk) : void {
        $this->prixBatk = $prixBatk;
    }

}