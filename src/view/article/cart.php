<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // Je comprends pas comment faire sans
        use App\Covoiturage\Model\Repository\ArticleRepository;
        use App\Covoiturage\Model\Repository\PanierRepository;

        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            
            // On récupère le panier de l'utilisateur
            $panier = PanierRepository::getPanierByMail($user->getMail());

            // On sauvegarde le panier dans la session
            if($panier != null){
                $_SESSION['panier'] = $panier;
            }
        }

        if(isset($_SESSION['panier'])){
            $panier = $_SESSION['panier'];
            
            // Check if empty
            if($panier->getArticles() == null){
                echo "<p>Votre panier est vide</p>";
                return;
            }
            

            // Echo pay button
            $total = $panier->getTotal();
            echo "<form action='frontController.php?action=pay' method='post' class='payForm'>";
            echo "<input type='submit' value='Payer $total BATK' class='payButton'>";
            echo "</form>";

            echo "<div class='cards'>";
            foreach ($panier->getArticles() as $a) {
                $quantite = $a->getQuantite();

                $a = ArticleRepository::getArticleById(rawurlencode($a->getArticleId()));
                $id = $a->getId();
                // Remove from cart button

                echo "<a href='frontController.php?action=read&idArticle=" . $id . "'>";
                
                echo "<div class='card'>";
                echo "<img src=\"../images/".$a->getCheminImageTile()."\" alt = \"presentation\" class=\"cardImage\">";
                echo "<p>" . $a->getNom() . "</p>";
                echo "<p>Quantité : " . $quantite . "</p>";
                echo "<p>Prix total : " . $a->getPrixBatk() * $quantite . " <img src='../images/k.png' alt='Logo' class='coinIcon'></p>";
                echo "<form action='frontController.php?action=removeFromCart' method='post' class='removeForm'>";
                echo "<input type='hidden' name='idArticle' value='$id'>";
                echo "<input type='submit' value='Retirer du panier' class='removeButton'>";
                echo "</form>";
                echo "</div>";
                echo "</a>";
            }
            echo "</div>";
        }
        else{
            echo "<p>Le panier est vide</p>";
        }
        ?>
</body>
</html>
