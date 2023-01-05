<?php
namespace App\Covoiturage\Controller;


use App\Covoiturage\Model\DataObject\Panier;
use App\Covoiturage\Model\Repository\ArticleRepository;
use App\Covoiturage\Model\Repository\PanierRepository;
use App\Covoiturage\Model\Repository\UserRepository;

class ControllerPanier {

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../view/$cheminVue"; // Charge la vue
     }

    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        $articles = ArticleRepository::getArticles(); //appel au modèle pour gerer la BD
        static::afficheVue('view.php', ['articles' => $articles, 'pagetitle' => 'Liste des articles', 'cheminVueBody' => 'article/list.php']);
    }

    public static function pay(): void {
    // check if the user is connected
    if(!isset($_SESSION['user'])){
        self::error("Connectez vous d'abord");
        return;
    }
    // get all the articles
    $articles = ArticleRepository::getArticles();
    // get the user's panier
    $p = PanierRepository::getPanierByMail($_SESSION['user']->getMail());
    // if the panier is not null (it should not)
    if(isset($_SESSION['user']) && $p != null){
        // set the date of the panier
        $p->setDate(date("Y-m-d"));
        // save the panier
        PanierRepository::sauvegarder($p);
        // unset the panier session
        unset($_SESSION['panier']);
        // show the view
        static::afficheVue('view.php', ['pagetitle' => 'Commande passé', 'cheminVueBody' => 'article/achat.php', 'articles' => $articles]);
    }
    else {
        static::error("aucun panier");
    }
}

    public static function removeFromCart(){
        if(isset($_POST['idArticle'])){
            $panier = $_SESSION['panier'];
            $articles = ArticleRepository::getArticles();
            $panier->supprimerArticle(ArticleRepository::getArticleById($_POST['idArticle']));
            PanierRepository::sauvegarder($panier);
            header('Location: frontController.php');
        }
        else{
            static::error("aucun article");
        }
    }

    // public static function pay():void {
    //     if(!isset($_SESSION['user'])){
    //         self::error("Connectez vous d'abord");
    //     }
    //     else if(isset($_GET['idPanier'])){
    //         $panier = PanierRepository::getPanierById($_GET['idPanier']);
    //         if($panier != null && $panier->getEmailUtilisateur() == $_SESSION['user'] && $panier->getDate() == null){
    //             $panier->setDate(date());

    //             static::afficheVue('view.php',['pagetitle' => 'achat validé','articles' => ArticleRepository::getArticles(),'cheminVueBody' => 'article/achat.php']);
    //         }
    //         else{
    //             self::error("Panier inexistant");
    //         }
    //     }
    //     else{
    //         self::error("Panier non indiqué");
    //     }

    // }


    public static function error(string $errorMessage = "") : void {
        static::afficheVue('view.php', ['pagetitle' => 'Erreur', 'cheminVueBody' => 'article/error.php', 'errorMessage' => $errorMessage]);
    }

}
?>
