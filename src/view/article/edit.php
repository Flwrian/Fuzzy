<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Edit un article
    
    // On propose de modifier l'article
    echo "<form action='frontController.php?action=editArticle' method='post' class='editForm'>";
    echo "<input type='hidden' name='idArticle' value='" . $article->getId() . "'>";
    echo "<label for='nom'>Nom</label>";
    echo "<input type='text' name='nom' value='" . $article->getNom() . "'>";
    echo "<label for='description'>Description</label>";
    echo "<input type='text' name='description' value='" . $article->getDescription() . "'>";
    echo "<label for='prix'>Prix</label>";
    echo "<input type='text' name='prix' value='" . $article->getPrixBatk() . "'>";
    // File input
    echo "<label for='image'>Image</label>";
    echo "<input type='file' name='image' id='image' accept='image/png, image/jpeg'>";
    echo "<input type='submit' value='Modifier' class='editButton'>";
    echo "</form>";
    ?>
</body>
</html>