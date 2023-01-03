<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class Article {


    private string|null $id;
    private string $nom;
    private string $marque;
    private string $prixBatk;

    private string $cheminImageTile;

    private string $description;

    public function __construct(
        string|null $id,
        string $nom,
        string $marque,
        string $prixBatk,
        string $cheminImageTile = "rien.png",
        string $description = ""
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->marque = $marque;
        $this->prixBatk = $prixBatk;
        $this->cheminImageTile = $cheminImageTile;
        $this->description = $description;
    }

    public function __toString() : string {
        return "Article{id=$this->id, nom=$this->nom, marque=$this->marque, prixBatk=$this->prixBatk, cheminImageTile=$this->cheminImageTile}";

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

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $desc): void{
        $this->description = $desc;
    }

    public function getCheminImageTile() : string {
        return $this->cheminImageTile;
    }

    public function setCheminImageTile(string $chemin) : void{
        $this->cheminImageTile = $chemin;
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
