<?php
namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\DataObject\User;
use App\Covoiturage\Model\DataObject\Panier;
use App\Covoiturage\Model\Repository\ArticleRepository;
use App\Covoiturage\Model\Repository\UserRepository;
use App\Covoiturage\Model\Repository\PanierRepository;


class ControllerUser {

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../view/$cheminVue"; // Charge la vue
     }

    public static function connection(){
        static::afficheVue('view.php', ['pagetitle' => 'Connexion', 'cheminVueBody' => 'article/login.php']);
    }

    public static function authenticate(){

        /* On récupère nos variables POST */
        $mail = $_POST['email'];
        $mail = htmlspecialchars($mail);
        $password = $_POST['password'];
        $password = htmlspecialchars($password);

        $user = UserRepository::getUserByCredentials($mail, $password);
        $articles = ArticleRepository::getArticles();

        if($user == null){
            static::afficheVue('view.php', ['pagetitle' => 'Erreur', 'cheminVueBody' => 'article/error.php', 'errorMessage' => 'Utilisateur non trouvé']);
        }
        else{
            /* On setup la session */
            $_SESSION['user'] = $user;
            if(isset($_SESSION['panier'])){
                $_SESSION['panier']->setEmailUtilisateur($user->getMail());
                PanierRepository::sauvegarder($_SESSION['panier']);
            }

            /* On redirige le visiteur vers la page d'accueil */
            static::afficheVue('view.php', ['articles' => $articles, 'user' => $user, 'pagetitle' => 'Bienvenue', 'cheminVueBody' => 'article/list.php']);
        }
    }

    public static function deconnection(){
        /* On détruit la session */
        session_destroy();

        /* On redirige le visiteur vers la page d'accueil */
        header('Location: frontController.php');
    }

    public static function register(){

        /* On récupère nos variables POST */
        $mail = $_POST['email'];
        $mail = htmlspecialchars($mail);
        $password = $_POST['password'];
        $password = htmlspecialchars($password);

        $user = new User($mail, $password);

        $existeDeja = false;
        foreach (UserRepository::getUsers() as $u){
            if($u->getMail() == $user->getMail()){
                $existeDeja = true;
                break;
            }
        }

        if(!$existeDeja){
            UserRepository::sauvegarder($user);

            /* On setup la session */
            $_SESSION['user'] = $user;

            /* On redirige le visiteur vers la page d'accueil */
            header('Location: frontController.php');
        }
        self::afficheVue('view.php',['pagetitle' => 'Erreur','cheminVueBody' => 'article/error.php', 'errorMessage' => 'Utilisateur deja existant']);

    }

    public static function addPanier(){
        $id = $_POST['idArticle'];
        $article = ArticleRepository::getArticleById($id);

        if(isset($_SESSION['panier']))
            $panier = $_SESSION['panier'];
        else {
            $_SESSION['panier'] = new Panier();
            $panier = $_SESSION['panier'];
        }
        $panier->ajouterArticle($article,1);
        PanierRepository::sauvegarder($panier);
        header('Location: frontController.php');
    }

    public static function readPanier(){
        static::afficheVue('view.php', ['pagetitle' => 'Panier', 'cheminVueBody' => 'article/cart.php']);
    }

    public static function Admin(){
        $articles = ArticleRepository::getArticles();
        static::afficheVue('view.php', ['articles' => $articles,'pagetitle' => 'Admin', 'cheminVueBody' => 'article/admin.php']);
    }
}
