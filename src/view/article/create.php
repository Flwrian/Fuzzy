<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get" action="frontController.php">
    <input type='hidden' name='action' value='created'>
    <fieldset>
        <legend>Ajout d'un article / produit :</legend>
        <p>
        <label for="nomArticle">Nom</label> :
        <input type="text" placeholder="Ex : Glock 17 | Polymer" name="nomArticle" id="nomArticle" required/>
        </p>
        <p>
        <label for="marqueArticle">Marque</label> :
        <input type="text" placeholder="Ex : Glock" name="marqueArticle" id="marqueArticle" required/>
        </p>
        <p>
        <label for="prixBatkArticle">Prix de batk</label> :
        <input type="number" placeholder="Ex : 500" name="prixBatkArticle" id="prixBatkArticle" required/>
        </p>
        <p>
        <input type="submit" value="Créer" />
        </p>
    </fieldset> 
    </form>
</body>
</html>