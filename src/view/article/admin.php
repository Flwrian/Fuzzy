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
    if(isset($_SESSION['user']) && $_SESSION['user']->getAdmin()){
        echo "    <div id=\"panelAdmin\">
        <div class=\"button\">
            <a href=\"frontController.php?action=create\">Ajouter nouveau produit</a>
        </div>
    </div>";
    }
    else{
        echo "<p>pas les droits</p>";
    }
    ?>

</body>
</html>
