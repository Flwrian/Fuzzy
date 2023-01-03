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
            $p.setArticles(EstDansRepository::getArticlesByPanier($p->getIdPanier()));
            $tab[] = $p;
        }

        return $tab;
    }

    public static function getPanierById(int $idPanier) : Panier|null {
        $sql = "SELECT * from Panier WHERE idPanier = :idPanier";
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
            $p->setArticles(EstDansRepository::getArticlesByPanier($p->getIdPanier()));
            return $p;
        } else {
            return null;
        }
    }

    public static function construire($row) : Panier {
        return new Panier($row['idPanier'], $row['payementDate'], $row['emailUtilisateur']);
    }

    public static function sauvegarder(Panier $panier) : void {
        if(!isset($_SESSION['user'])){
            return;
        }
        // On regarde d'abord si l'utilisateur a déjà un panier ou la date de payement est null (donc pas encore payé)
        $sql = "SELECT * FROM Panier WHERE emailUtilisateur = :mail AND payementDate IS NULL";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "mail" => $_SESSION['user']->getMail(),
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        $panierResult= $pdoStatement->fetch();

        // Si l'utilisateur a déjà un panier, on récupère son id
        if($panierResult){
            $panier->setIdPanier($panierResult['idPanier']);
        }

        // Sinon on laisse l'id a null pour laisser la base de données s'occuper de l'auto-incrémentation

        $panier->setEmailUtilisateur($_SESSION['user']->getMail());
        $sql = "INSERT INTO Panier (idPanier, payementDate, emailUtilisateur) VALUES(:idPanier, :payement, :mail) ON DUPLICATE KEY UPDATE
payementDate = :payement, emailUtilisateur = :mail";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);


        $values = array(
            "idPanier" => $panier->getIdPanier(),
            "payement" => $panier->getDate(),
            "mail" => $panier->getEmailUtilisateur(),
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        foreach($panier->getArticles() as $dedans){
            if($panier->getIdPanier() != null){
                $dedans->setIdPanier($panier->getIdPanier());
            }
            else{
                $dedans->setIdPanier(DatabaseConnection::getPdo()->lastInsertId());
            }
            EstDansRepository::sauvegarder($dedans);
        }
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
