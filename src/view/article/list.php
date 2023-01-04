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
            echo "<p>" . $a->getPrixBatk() . " <img src='../images/k.png' alt='Logo' class='coinIcon'></p>";
            // If admin is connected, display the delete button
            if (isset($_SESSION['user']) && $_SESSION['user']->getAdmin()) {
                // Delete
                echo "<form action='frontController.php?action=delete' method='post' class='deleteForm'>";
                echo "<input type='hidden' name='idArticle' value='$id'>";
                echo "<input type='submit' value='Supprimer' class='deleteButton'>";
                echo "</form>";
                // Edit
                echo "<form action='frontController.php?action=edit' method='post' class='editForm'>";
                echo "<input type='hidden' name='idArticle' value='$id'>";
                echo "<input type='submit' value='Modifier' class='editButton'>";
                echo "</form>";
            }
            
            echo "</div>";
            echo "</a>";
        }
        echo "</div>";
        ?>
    </body>
</html>
