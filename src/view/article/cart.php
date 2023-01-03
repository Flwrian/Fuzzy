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

        if(isset($_SESSION['panier'])){
            $panier = $_SESSION['panier'];
            

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

                /* Clickable cards */
                echo "<a href='frontController.php?action=read&idArticle=" . $id . "'>";

                echo "<div class='card'>";
                echo "<img src=\"../images/".$a->getCheminImageTile()."\" alt = \"presentation\" class=\"cardImage\">";
                echo "<p>Nom : " . $a->getNom() . "</p>";
                echo "<p>Marque : " . $a->getMarque() . "</p>";
                echo "<p>Prix unité : " . $a->getPrixBatk() . "</p>";
                echo "<p>Quantité : " . $quantite . "</p>";
                echo "<p>Prix total : " . $a->getPrixBatk() * $quantite . "</p>";
                echo "<img src='../images/k.png' alt='Logo' class='coinIcon'>";
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