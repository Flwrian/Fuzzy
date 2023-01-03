<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Panier;
use App\Covoiturage\Model\Repository\DatabaseConnection;   

class UserRepository {

    public static function getUserByCredentials(string $username, string $email, string $password) : Panier|null {
        $db = DatabaseConnection::getPdo();
        $query = $db->prepare("SELECT * FROM UtilisateurFuzzy WHERE username = :username AND mail = :mail AND password = :password");
        $query->execute([
            "username" => $username,
            "mail" => $email,
            "password" => $password
        ]);
        $result = $query->fetch();
        if ($result) {
            return new Panier(
                $result["username"],
                $result["mail"],
                $result["password"],
                $result["admin"]
            );
        }
        return null;
    }

    public static function sauvegarder(Panier $user) : void {
        $db = DatabaseConnection::getPdo();
        $query = $db->prepare("INSERT INTO UtilisateurFuzzy (username, mail, password) VALUES (:username, :mail, :password)");
        $query->execute([
            "username" => $user->getUsername(),
            "mail" => $user->getMail(),
            "password" => $user->getPassword()
        ]);

        if ($query->errorCode() !== "00000") {
            throw new \Exception("Erreur lors de l'insertion de l'utilisateur");
        }
    }
}