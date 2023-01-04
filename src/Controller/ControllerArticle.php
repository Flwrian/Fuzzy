<?php
namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\DataObject\Article;
use App\Covoiturage\Model\DataObject\Panier;
use App\Covoiturage\Model\Repository\ArticleRepository;
use App\Covoiturage\Model\Repository\UserRepository;

class ControllerArticle {

    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../view/$cheminVue"; // Charge la vue
     }

    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        $articles = ArticleRepository::getArticles(); //appel au modèle pour gerer la BD
        static::afficheVue('view.php', ['articles' => $articles, 'pagetitle' => 'Liste des articles', 'cheminVueBody' => 'article/list.php']);
    }

    public static function read() : void {
        $articles = ArticleRepository::getArticleById($_GET['idArticle']);
        if($articles == null) {
            static::afficheVue('view.php', ['pagetitle' => 'Erreur', 'cheminVueBody' => 'article/error.php', 'errorMessage' => 'Article non trouvé']);
        }
        else{
            static::afficheVue('view.php', ['articles' => $articles, 'pagetitle' => 'Détail de la page', 'cheminVueBody' => 'article/detail.php']);
        }
    }


    public static function create() : void {
        static::afficheVue('view.php', ['pagetitle' => 'Création de la page', 'cheminVueBody' => 'article/create.php']);
    }

    public static function created() : void {
        $nom = $_POST['nomArticle'];
        $nom = htmlspecialchars($nom);
        $marque = $_POST['marqueArticle'];
        $marque = htmlspecialchars($marque);
        $prixBatk = $_POST['prixBatkArticle'];
        $prixBatk = htmlspecialchars($prixBatk);
        $description = $_POST['descriptionArticle'];
        $description = htmlspecialchars($description);
        $nomImage = null;

        $article = new Article(null, $nom, $marque, $prixBatk);
        $article->setDescription($description);

        if(isset($_FILES['inputFile']) && is_uploaded_file($_FILES['inputFile']['tmp_name'])) {
            $errors = array();
            $file_name =
            $file_tmp = $_FILES['inputFile']['tmp_name'];

            $array = explode('.', $_FILES['inputFile']['name']);
            $file_ext = strtolower(end($array));

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension interdite";
            }

            if (empty($errors) == true) {
                $num_files = count(glob("../images/*"));
                $nomImage = $num_files . "." . $file_ext;
                file_put_contents("../images/" . $nomImage, file_get_contents($file_tmp));
                $article->setCheminImageTile($nomImage);
            } else {
                print_r($errors);
            }
        }


        ArticleRepository::sauvegarder($article);
        $articles = ArticleRepository::getArticles();

        static::afficheVue('view.php', ['article' => $article, 'pagetitle' => 'Article créee', 'cheminVueBody' => 'article/created.php', 'articles' => $articles]);
    }

    public static function delete() : void {

        // If admin


        $id = $_GET['idArticle'];
        $id = htmlspecialchars($id);
        $article = ArticleRepository::getArticleById($id);
        ArticleRepository::supprimerParId($article->getId());
        $articles = ArticleRepository::getArticles();
        static::afficheVue('view.php', ['article' => $article, 'pagetitle' => 'Article supprimée', 'cheminVueBody' => 'article/deleted.php', 'articles' => $articles]);
    }

    public static function error(string $errorMessage = "") : void {
        static::afficheVue('view.php', ['pagetitle' => 'Erreur', 'cheminVueBody' => 'article/error.php', 'errorMessage' => $errorMessage]);
    }

    public static function search() : void {
        $query = $_GET['query'];
        $query = htmlspecialchars($query);
        $articles = ArticleRepository::getArticlesByQuery($query);
        static::afficheVue('view.php', ['articles' => $articles, 'pagetitle' => 'Recherche des articles', 'cheminVueBody' => 'article/search.php', 'query' => $query]);
    }
}
?>
