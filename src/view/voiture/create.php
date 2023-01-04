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
        <legend>Mon formulaire :</legend>
        <p>
        <label for="immat_id">Immatriculation</label> :
        <input type="text" placeholder="256AB34" name="immat_id" id="immat_id" required/>
        </p>
        <p>
        <label for="marque_id">Marque</label> :
        <input type="text" placeholder="Ex : Renault" name="marque_id" id="marque_id" required/>
        </p>
        <p>
        <label for="couleur_id">Couleur</label> :
        <input type="text" placeholder="Ex : Bleu" name="couleur_id" id="couleur_id" required/>
        </p>
        <p>
        <label for="nbSieges_id">Nombre de sièges</label> :
        <input type="number" placeholder="Ex : 5" name="nbSieges_id" id="nbSieges_id" required/>
        </p>
        <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
    </form>
</body>
</html>