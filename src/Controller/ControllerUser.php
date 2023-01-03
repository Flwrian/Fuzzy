<?php
namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\DataObject\Panier;
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

        /* On récupère nos variables POST */
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
            /* On setup la session */
            $_SESSION['user'] = $user;

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
        $login = $_POST['username'];
        $login = htmlspecialchars($login);
        $mail = $_POST['email'];
        $mail = htmlspecialchars($mail);
        $password = $_POST['password'];
        $password = htmlspecialchars($password);

        $user = new Panier($login, $mail, $password);

        UserRepository::sauvegarder($user);

        /* On setup la session */
        $_SESSION['user'] = $user;

        /* On redirige le visiteur vers la page d'accueil */
        header('Location: frontController.php');
    }

    public static function addPanier(){
        $id = $_GET['id'];
        $article = ArticleRepository::getArticleById($id);
        
        if(isset($_SESSION['panier']))
            $panier = $_SESSION['panier'];
        else
            $panier = new Panier(0);

        $panier->ajouterArticle($article);
        header('Location: frontController.php');
    }
}