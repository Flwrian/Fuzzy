<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\User;
use App\Covoiturage\Model\Repository\DatabaseConnection;

class UserRepository {

    public static function getUserByCredentials(string $username, string $email, string $password) : User|null {
        $db = DatabaseConnection::getPdo();
        $query = $db->prepare("SELECT * FROM UtilisateurFuzzy WHERE username = :username AND mail = :mail AND password = :password");
        $query->execute([
            "username" => $username,
            "mail" => $email,
            "password" => $password
        ]);
        $result = $query->fetch();
        if ($result) {
            return new User(
                $result["username"],
                $result["mail"],
                $result["password"],
                $result["admin"]
            );
        }
        return null;
    }

    public static function sauvegarder(User $user) : void {
        $db = DatabaseConnection::getPdo();
        $query = $db->prepare("INSERT INTO UtilisateurFuzzy (username, mail, password, admin) VALUES (:username, :mail, :password, :admin)");
        $query->execute([
            "username" => $user->getUsername(),
            "mail" => $user->getMail(),
            "password" => $user->getPassword(),
            "admin" => $user->getAdmin(),
        ]);

        if ($query->errorCode() !== "00000") {
            throw new \Exception("Erreur lors de l'insertion de l'utilisateur");
        }
    }
}
