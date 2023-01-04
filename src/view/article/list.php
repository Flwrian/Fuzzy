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

            /* Clickable cards */
            echo "<a href='frontController.php?action=read&idArticle=" . $id . "'>";

            echo "<div class='card'>";
            echo "<img src=\"../images/".$a->getCheminImageTile()."\" alt = \"presentation\" class=\"cardImage\">";
            echo "<p>" . $a->getNom() . "</p>";
            echo "<p>" . $a->getPrixBatk() . " BATK</p>";
            echo "<img src='../images/k.png' alt='Logo' class='coinIcon'>";
            echo "</div>";
            echo "</a>";
        }
        echo "</div>";
        ?>
    </body>
</html>