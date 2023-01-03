<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Détail article</title>
    </head>
    <body>
        <main id="articleDetail">
            <div id="colonneGauche">
                <?php
                echo "<img src=\"../images/".$articles->getCheminImageTile()."\" alt=\"image du produit\" class=\"imageProduit\">"
                ?>
            </div>
            <div id="description">
                <?php
                echo "<h1>".$articles->getNom()."</h1>";
                echo "<p>".$articles->getDescription()."</p>";
                ?>
            </div>
            <div id="acheter">
                <?php
                echo "<h1>".$articles->getPrixBatk()." <img src='../images/k.png' alt='Logo' class='coinIcon'></h1>"
                ?>
                <form id="formPanier" action="frontController.php?action=addPanier" method="post">
                    <input type="hidden" name="idArticle" value="<?php echo $articles->getId(); ?>">
                    <input type="submit" value="Ajouter au panier" class="button">
                </form>
            </div>
        </main>
    </body>
</html>