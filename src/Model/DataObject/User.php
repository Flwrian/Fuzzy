<?php

namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Model\Repository\DatabaseConnection;

class User {

    private string $username;
    private string $mail;
    private string $password;

    private int $admin;

    private $cart = [];

    public function __construct(
        string $username,
        string $mail,
        string $password,
        int $admin = 0
    ) {
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
        $this->admin = $admin;
    }

    public function getUsername() : string {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getAdmin(): int
    {
        return $this->admin;
    }

    /**
     * @param int $admin
     */
    public function setAdmin(int $admin): void
    {
        $this->admin = $admin;
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

    public function setCart(array $cart) : void {
        $this->cart = $cart;
    }

    public function addToCart(Article $article) : void {
        $this->cart[] = $article;
    }

    public function removeFromCart(Article $article) : void {
        $key = array_search($article, $this->cart);
        if($key !== false){
            unset($this->cart[$key]);
        }
    }

    public function save() : void {
        $db = DatabaseConnection::getDatabaseConnection();
        $db->saveUser($this);
    }

    public function delete() : void {
        $db = DatabaseConnection::getDatabaseConnection();
        $db->deleteUser($this);
    }

    public function isAdmin() : int {
        return $this->admin;
    }
}
