<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class Panier {

    private ?int $idPanier;
    private ?string $date;
    private ?string $emailUtilisateur;

    private array $articles = []; // /!\ doit contenir des "estDans"

    public function __construct(
        int $idPanier = null,
        string $date = null,
        string $emailUtilisateur = null
    ) {
        $this->idPanier = $idPanier;
        $this->date = $date;
        $this->emailUtilisateur = $emailUtilisateur;
    }


    /**
     * @return int
     */
    public function getIdPanier(): int
    {
        return $this->idPanier;
    }

    /**
     * @param int $idPanier
     */
    public function setIdPanier(int $idPanier): void
    {
        $this->idPanier = $idPanier;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getEmailUtilisateur(): ?string
    {
        return $this->emailUtilisateur;
    }

    /**
     * @param string|null $emailUtilisateur
     */
    public function setEmailUtilisateur(?string $emailUtilisateur): void
    {
        $this->emailUtilisateur = $emailUtilisateur;
    }

    /**
     * @return array
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    public function ajouterArticle(Article $article, int $quantite): void{
        $this->articles[] = new EstDans($this->$this->idPanier, $article->getId(),$quantite);
    }
    public function setArticles(array $articles):void
    {
        $this->articles = $articles;
    }

}
