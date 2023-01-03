<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\DataObject\EstDans;
use App\Covoiturage\Model\Repository\DatabaseConnection;


class EstDansRepository {

    public static function getArticlesByPanier(int $idPanier): array {

        $tab = [];

        $pdoStatement = DatabaseConnection::getPdo()->prepare("SELECT * FROM estDans WHERE idPanier = :idPanier");

        $values = array(
            "idPanier" => $idPanier,
            //nomdutag => valeur, ...
        );

        $pdoStatement->execute($values);

        foreach ($pdoStatement as $row) {
            $tab[] = static::construire($row);
        }

        return $tab;
    }

    public static function construire($row): estDans{
        return new EstDans($row['idPanier'],$row['idArticle'],$row['quantité']);
    }

    public static function sauvegarder(EstDans $lien){
        $db = DatabaseConnection::getPdo();
        $sql = "INSERT INTO estDans (idPanier, idArticle, quantité) VALUES (:idPanier, :idArticle, :quantite)";
        $pdoStatement = $db->prepare($sql);
        $values = array(
            "idPanier" => $lien->getIdPanier(),
            "idArticle" => $lien->getArticleId(),
            "quantite" => $lien->getQuantite(),
        );
        $pdoStatement->execute($values);

    }

    public static function supprimerParId(int $idPanier, string $idArticle) : void {
        $sql = "DELETE FROM estDans WHERE idArticle = :idArticle AND idPanier = :idPanier";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idArticle" => $idArticle,
            "idPanier" => $idPanier,
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }

}
