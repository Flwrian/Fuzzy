<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bodycreate">
    <form method="POST" action="frontController.php?action=created" enctype="multipart/form-data">
    <fieldset>
        <legend>Ajout d'un article / produit :</legend>
        <p>
        <label for="nomArticle">Nom</label>
        <input type="text" placeholder="Ex : Glock 17 | Polymer" name="nomArticle" id="nomArticle" required/>
        </p>
        <p>
        <label for="marqueArticle">Marque</label>
        <input type="text" placeholder="Ex : Glock" name="marqueArticle" id="marqueArticle" required/>
        </p>
        <p>
        <label for="prixBatkArticle">Prix de batk</label>
        <input type="number" placeholder="Ex : 500" name="prixBatkArticle" id="prixBatkArticle" required/>
        </p>
        <p>
            <label for="descriptionArticle">Description</label>
            <input type="text" name="descriptionArticle" id="descriptionArticle" required>
        </p>
        <p>
            <label for="inputFile">Image</label>
            <input type="file" id="inputFile" name="inputFile" accept="image/png, image/jpeg"/>
        </p>
        <p>
        <input type="submit" value="Créer" />
        </p>

    </fieldset>
    </form>
</body>
</html>
