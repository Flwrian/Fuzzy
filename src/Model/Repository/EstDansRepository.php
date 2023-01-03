<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\Repository\DatabaseConnection;


class EstDansRepository {

    public static function getArticlesByPanier(int $idPanier): array {

        $tab = [];

        $pdoStatement = DatabaseConnection::getPdo()->prepare("SELECT a.id,nom,marque,prixBatk,ImageTile,description FROM ArticleFuzzy a JOIN estDans e ON a.id = e.idArticle WHERE e.idPanier = :idPanier");


        $values = array(
            "idPanier" => $idPanier,
            //nomdutag => valeur, ...
        );

        foreach ($pdoStatement as $row) {
            $tab[] = ArticleRepository::construire($row);
        }

        return $tab;
    }

}
