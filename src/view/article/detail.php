<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Détail article</title>
    </head>
    <body>
    <wrap class="wrapper">
        <?php
        echo "Article : " . $articles->getNom() . "<br>" . $articles->getMarque() . "<br>" . $articles->getPrixBatk() . "<br>";
        ?>
</wrap>
    </body>
</html>