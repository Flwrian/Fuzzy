<?php
namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\DataObject\User;
use App\Covoiturage\Model\Repository\ArticleRepository;
use App\Covoiturage\Model\Repository\UserRepository;

class ControllerUser {

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../view/$cheminVue"; // Charge la vue
     }
    
    public static function connection(){
        static::afficheVue('view.php', ['pagetitle' => 'Connexion', 'cheminVueBody' => 'article/login.php']);
    }

    public static function authenticate(){

        $login = $_POST['username'];
        $login = htmlspecialchars($login);
        $mail = $_POST['email'];
        $password = $_POST['password'];
        $password = htmlspecialchars($password);

        $user = UserRepository::getUserByCredentials($login, $mail, $password);
        $articles = ArticleRepository::getArticles();

        if($user == null){
            static::afficheVue('view.php', ['pagetitle' => 'Erreur', 'cheminVueBody' => 'article/error.php', 'errorMessage' => 'Utilisateur non trouvé']);
        }
        else{
            $_SESSION['user'] = $user;
            static::afficheVue('view.php', ['articles' => $articles, 'user' => $user, 'pagetitle' => 'Bienvenue', 'cheminVueBody' => 'article/list.php']);
        }
    }

    public static function deconnection(){
        session_destroy();
        $articles = ArticleRepository::getArticles();
        header('Location: frontController.php');
    }
}