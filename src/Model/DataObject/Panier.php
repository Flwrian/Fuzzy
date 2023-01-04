<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;
use App\Covoiturage\Model\Repository\ArticleRepository;

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

    public function __toString(): string {
        return "Le panier " . $this->idPanier . " contient " . $this->getTotal() . "€";
    }

    public function getTotal(): float {
        $total = 0;
        foreach ($this->articles as $estDans) {
            $total += $estDans->getQuantite() * ArticleRepository::getArticleById($estDans->getArticleId())->getPrixBatk();
        }
        return $total;
    }


    /**
     * @return int
     */
    public function getIdPanier(): ?int
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
        // If there is already an article in the cart, we just add the quantity
        foreach ($this->articles as $estDans) {
            if ($estDans->getArticleId() === $article->getId()) {
                $estDans->setQuantite($estDans->getQuantite() + $quantite);
                return;
            }
        }
        // Else, we add a new "estDans" to the cart
        $this->articles[] = new EstDans($this->idPanier, $article->getId(), $quantite);
    }

    public function supprimerArticle(Article $article): void{
        // Remove from database
        $db = DatabaseConnection::getPDO();
        $query = $db->prepare("DELETE FROM estDans WHERE idPanier = :idPanier AND idArticle = :idArticle");
        $query->execute([
            "idPanier" => $this->idPanier,
            "idArticle" => $article->getId()
        ]);
        // Remove from array
        foreach ($this->articles as $key => $estDans) {
            if ($estDans->getArticleId() === $article->getId()) {
                unset($this->articles[$key]);
            }
        }
    }
    public function setArticles(array $articles):void
    {
        $this->articles = $articles;
    }

}
