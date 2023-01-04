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

    public static function getPanierByMail(string $mail) : Panier | null {
        $sql = "SELECT * from Panier WHERE emailUtilisateur = :mail && payementDate IS NULL";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "mail" => $mail,
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
        $p = new Panier($row['idPanier'], $row['payementDate'], $row['emailUtilisateur']);
        $articles = EstDansRepository::getArticlesByPanier($p->getIdPanier());
        if($articles != null){
            $p->setArticles($articles);
        }
        return $p;
    }

    public static function getPanierFromEmail(string $mail): Panier | null{
        $sql = "SELECT * FROM Panier WHERE emailUtilisateur = :mail AND payementDate IS NULL";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "mail" => $mail,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        $panierResult= $pdoStatement->fetch();
        if($panierResult){
            return static::construire($panierResult);
        }
        return null;
    }

    public static function sauvegarder(Panier $panier) : void {
        if(!isset($_SESSION['user'])){
            return;
        }

        $sql = "INSERT INTO Panier(idPanier,payementDate, emailUtilisateur) VALUES(:idPanier,:dat,:email) ON DUPLICATE KEY UPDATE payementDate  = :dat, emailUtilisateur = :email";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idPanier" => $panier->getIdPanier(),
            "dat" => $panier->getDate(),
            "email" => $panier->getEmailUtilisateur(),
        );

        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        $distant = static::getPanierFromEmail($_SESSION['user']->getMail());

        // Si l'utilisateur a déjà un panier, on récupère son id et on ecrase son panier
        if($distant != null){
            $panier->setIdPanier($distant->getIdPanier());
            EstDansRepository::supprimerParPanier($panier->getIdPanier());
            foreach ($panier->getArticles() as $article) {
                $article->setIdPanier($panier->getIdPanier());
                EstDansRepository::sauvegarder($article);
            }
        }
    }

    public static function supprimerParId(int $idPanier) : void {
        $sql = "DELETE FROM Panier WHERE idPanier = :idPanier";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idPanier" => $idPanier,
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
    }
}
