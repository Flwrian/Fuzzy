<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\User;
use App\Covoiturage\Model\Repository\DatabaseConnection;

class UserRepository {

    public static function getUserByCredentials(string $email, string $password) : User|null {
        $db = DatabaseConnection::getPdo();
        $query = $db->prepare("SELECT * FROM UtilisateurFuzzy WHERE mail = :mail AND password = :password");
        $query->execute([
            "mail" => $email,
            "password" => $password
        ]);
        $result = $query->fetch();
        if ($result) {
            return new User(
                $result["mail"],
                $result["password"],
                $result["admin"]
            );
        }
        return null;
    }

    public static function getUsers(): array{

        $tab = [];

        $pdoStatement = DatabaseConnection::getPdo()->query("SELECT * FROM UtilisateurFuzzy");

        foreach ($pdoStatement as $row) {
            $tab[] = static::construire($row);
        }

        return $tab;
    }
    public static function construire($row) : User {
        return new User($row['mail'],$row['password'],$row['admin']);
    }
    public static function sauvegarder(User $user) : void {
        $db = DatabaseConnection::getPdo();
        $query = $db->prepare("INSERT INTO UtilisateurFuzzy (mail, password, admin) VALUES (:mail, :password, :admin)");
        $query->execute([
            "mail" => $user->getMail(),
            "password" => $user->getPassword(),
            "admin" => $user->getAdmin(),
        ]);

        if ($query->errorCode() !== "00000") {
            throw new \Exception("Erreur lors de l'insertion de l'utilisateur");
        }
    }
}
