<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class EstDans {

    private int $idPanier;
    private ?string $idArticle;

    private int $quantite;

    public function __construct(
        int $idPanier,
        string $idArticle,
        string $quantite,
    ) {
        $this->idPanier = $idPanier;
        $this->idArticle = $idArticle;
        $this->quantite = $quantite;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return array
     */
    public function getArticleId(): string
    {
        return $this->idArticle;
    }

    /**
     * @param array $articles
     */
    public function setArticleId(string $id): void
    {
        $this->articles = $id;
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



}
