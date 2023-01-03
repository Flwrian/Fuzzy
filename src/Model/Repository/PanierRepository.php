<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Panier;
use App\Covoiturage\Model\Repository\DatabaseConnection;


class PanierRepository {

    public static function getPanier() : array {

        $tab = [];

        $pdoStatement = DatabaseConnection::getPdo()->query("SELECT * FROM Panier");

        foreach ($pdoStatement as $row) {
            $p = PanierRepository::construire($row);
            $p.setArticles(ArticleRepository::getArticlesByPanier($p->getId()));
            $tab[] = $p;
        }

        return $tab;
    }

    public static function getPanierById(int $idPanier) : Panier|null {
        $sql = "SELECT * from Panier WHERE id = :idPanier";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idPanier" => $idPanier,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $panier= $pdoStatement->fetch();

        if ($panier) {
            // static::construire($voiture) est la même chose que Voiture::construire($voiture) mais est plus flexible si on veut changer le nom de la classe par exemple.
            $p = PanierRepository::construire($panier);
            $p.setArticles(ArticleRepository::getArticlesByPanier($p->getId()));
            return $p;
        } else {
            return null;
        }
    }

    public static function construire($row) : Panier {
        return new Panier($row['idPanier'], $row['payementDate'], $row['emailUtilisateur']);
    }

    public static function sauvegarder(Panier $panier) : void {
        $sql = "INSERT INTO ArticleFuzzy (id, nom, marque, prixBatk) VALUES (:idArticle, :nomArticle, :marqueArticle, :prixBatk)";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idArticle" => $article->getId(),
            "nomArticle" => $article->getNom(),
            "marqueArticle" => $article->getMarque(),
            "prixBatk" => $article->getPrixBatk(),
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }

    public static function supprimerParId(int $idPanier) : void {
        $sql = "DELETE FROM Panier WHERE id = :idPanier";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idPanier" => $idPanier,
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }
}
