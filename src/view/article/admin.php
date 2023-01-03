<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <!--create an admin page with all the articles-->
    <?php

                echo "<div class='cards'>";
                foreach ($articles as $a) {
                    $id = rawurlencode($a->getId());

                    /* Clickable cards */
                    echo "<a href='frontController.php?action=read&idArticle=" . $id . "'>";
                    echo "<div class='pack'>";
                    echo "<div class='card'>";
                    echo "<img src=\"../images/".$a->getCheminImageTile()."\" alt = \"presentation\" class=\"cardImage\">";
                    echo "<p>Nom : " . $a->getNom() . "</p>";
                    echo "<p>Marque : " . $a->getMarque() . "</p>";
                    echo "<p>Prix : " . $a->getPrixBatk() . "</p>";
                    echo "<img src='../images/k.png' alt='Logo' class='coinIcon'>";
                    echo "</div>";

                    echo "</a>";
                    echo "<a href='frontController.php?action=delete&idArticle=" . $id . "'>Supprimer</a>";
                    echo "</div>";
                }
                echo "</div>";

        ?>
</body>
</html>