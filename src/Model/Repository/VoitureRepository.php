<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Voiture;
use App\Covoiturage\Model\Repository\DatabaseConnection;    


class VoitureRepository {

    public static function getVoitures() : array {

        $tab = [];

        $pdoStatement = DatabaseConnection::getPdo()->query("SELECT * FROM voiture");

        foreach ($pdoStatement as $row) {
            $tab[] = VoitureRepository::construire($row);
        }

        return $tab;
    }

    public static function getVoitureParImmat(string $immatriculation) : Voiture|null {
        $sql = "SELECT * from voiture WHERE immatriculation = :immatriculationTag";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
    
        $values = array(
            "immatriculationTag" => $immatriculation,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    
        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $voiture = $pdoStatement->fetch();

        if ($voiture) {
            // static::construire($voiture) est la même chose que Voiture::construire($voiture) mais est plus flexible si on veut changer le nom de la classe par exemple.
            return static::construire($voiture);
        } else {
            return null;
        }
    }

    public static function construire($row) : Voiture {
        return new Voiture($row['immatriculation'], $row['marque'], $row['couleur'], $row['nbSieges']);
    }

    public static function sauvegarder(Voiture $voiture) : void {
        $sql = "INSERT INTO voiture (immatriculation, marque, couleur, nbSieges) VALUES (:immatriculationTag, :marqueTag, :couleurTag, :nbSiegesTag)";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
    
        $values = array(
            "immatriculationTag" => $voiture->getImmatriculation(),
            "marqueTag" => $voiture->getMarque(),
            "couleurTag" => $voiture->getCouleur(),
            "nbSiegesTag" => $voiture->getNbSieges(),
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }

    public static function supprimerParImmatriculation($immatriculation){
        $sql = "DELETE FROM voiture WHERE immatriculation = :immatriculationTag";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
    
        $values = array(
            "immatriculationTag" => $immatriculation,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }
}