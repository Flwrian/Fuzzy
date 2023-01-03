<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class User {

    private string $username;
    private string $mail;
    private string $password;
    private $cart = [];

    public function __construct(
        string $username,
        string $mail,
        string $password
    ) {
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function getMail() : string {
        return $this->mail;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function getCart() : array {
        return $this->cart;
    }
}