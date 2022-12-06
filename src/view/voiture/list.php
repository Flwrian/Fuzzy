<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des voitures</title>
    </head>
    <body>
        <?php
        foreach ($voitures as $v) {
            $immat = rawurlencode($v->getImmatriculation());
            // Div pour chaque voiture qui contient le détail de la voiture et le lien pour supprimer la voiture
            echo "<div>";
            echo "<p>Immatriculation : " . $v->getImmatriculation() . "</p>";
            echo "<p>Marque : " . $v->getMarque() . "</p>";
            echo "<p>Couleur : " . $v->getCouleur() . "</p>";
            echo "<p>Nombre de sièges : " . $v->getNbSieges() . "</p>";
            echo "<a href='frontController.php?action=read&immat=" . $immat . "'>Détails</a>";
            echo "<a href='frontController.php?action=delete&immat_id=" . $immat . "'>Supprimer</a>";
            echo "</div>";
        }
        ?>
    </body>
</html>