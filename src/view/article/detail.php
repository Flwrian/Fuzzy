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
                <form id="formPanier">
                    <button type="button">
                        Mettre dans le panier
                    </button>
                </form>
            </div>
        </main>
    </body>
</html>