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
            // If admin is connected, display the delete button
            if (isset($_SESSION['user']) && $_SESSION['user']->getAdmin()) {
                echo "<a href='frontController.php?action=delete&idArticle=" . $id . "' class='deleteButton'>
                    <img src='../images/delete.png' alt='Supprimer' class='deleteImage'>
                </a>";
            }
            echo "<img src=\"../images/".$a->getCheminImageTile()."\" alt = \"presentation\" class=\"cardImage\">";
            echo "<p>" . $a->getNom() . "</p>";
            echo "<p>" . $a->getPrixBatk() . " <img src='../images/k.png' alt='Logo' class='coinIcon'></p>";
            echo "</div>";
            echo "</a>";
        }
        echo "</div>";
        ?>
    </body>
</html>