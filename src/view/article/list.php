<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des articles</title>
    </head>
    <body>
        <?php
        echo "<div class='cards'>";
        foreach ($articles as $a) {
            $id = rawurlencode($a->getId());

            echo "<div class='card'>";
            echo "<img src=\"../images/".$a->getCheminImageTile()."\" alt = \"presentation\" class=\"cardImage\">";
            echo "<p>Nom : " . $a->getNom() . "</p>";
            echo "<p>Marque : " . $a->getMarque() . "</p>";
            echo "<p>Prix : " . $a->getPrixBatk() . "</p>";
            echo "<a href='frontController.php?action=read&idArticle=" . $id . "'>Détails</a>";
            echo "<a href='frontController.php?action=delete&idArticle=" . $id . "'>Supprimer</a>";
            echo "<img src='../images/k.png' alt='Logo' class='coinIcon'>";
            echo "</div>";
        }
        echo "</div>";
        ?>
    </body>
</html>
