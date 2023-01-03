<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\Repository\DatabaseConnection;


class ArticleRepository {

    public static function getArticles() : array {

        $tab = [];

        $pdoStatement = DatabaseConnection::getPdo()->query("SELECT * FROM ArticleFuzzy");

        foreach ($pdoStatement as $row) {
            $tab[] = ArticleRepository::construire($row);
        }

        return $tab;
    }

    public static function getArticleById(string $idArticle) : Article|null {
        $sql = "SELECT * from ArticleFuzzy WHERE id = :idArticle";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idArticle" => $idArticle,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $article = $pdoStatement->fetch();

        if ($article) {
            // static::construire($voiture) est la même chose que Voiture::construire($voiture) mais est plus flexible si on veut changer le nom de la classe par exemple.
            return static::construire($article);
        } else {
            return null;
        }
    }

    public static function getArticlesByQuery(string $query) : array {
        $sql = "SELECT * from ArticleFuzzy WHERE nom LIKE :query OR marque LIKE :query";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "query" => "%" . $query . "%",
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $tab = [];
        foreach ($pdoStatement as $row) {
            $tab[] = static::construire($row);
        }

        return $tab;
    }

    public static function construire($row) : Article {
        return new Article($row['id'], $row['nom'], $row['marque'], $row['prixBatk'],$row['ImageTile'],$row['description']);
    }

    public static function sauvegarder(Article $article) : void {
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

    public static function supprimerParId(string $idArticle) : void {
        $sql = "DELETE FROM ArticleFuzzy WHERE id = :idArticle";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idArticle" => $idArticle,
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }
}
