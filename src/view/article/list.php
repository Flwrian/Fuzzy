<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des articles</title>
    </head>
    <body>
        <?php
        /* Contenu de la page, on affiche tout les articles sous forme de cartes */
        echo "<div class='cards'>";

        /* Pour chaque article, on affiche une carte */
        foreach ($articles as $a) {
            $id = rawurlencode($a->getId());
            
            /* Clickable cards */
            echo "<a href='frontController.php?action=read&idArticle=" . $id . "'>";

            echo "<div class='card'>";

            /* Cards info */
            echo "<p>Nom : " . $a->getNom() . "</p>";
            echo "<p>Marque : " . $a->getMarque() . "</p>";
            echo "<p>Prix : " . $a->getPrixBatk() . "</p>";
            echo "<img src='../images/k.png' alt='Logo' class='coinIcon'>";

            echo "</div>";
            echo "</a>";
        }
        echo "</div>";
        ?>
    </body>
</html>