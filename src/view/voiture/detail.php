<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Détail voiture</title>
    </head>
    <body>
        <?php
        echo "Voiture : " . $voitures->getImmatriculation() . " de marque " . $voitures->getMarque() . " de couleur " . $voitures->getCouleur() . " et de nombre de sièges " . $voitures->getNbSieges() . ".";
        ?>
    </body>
</html>