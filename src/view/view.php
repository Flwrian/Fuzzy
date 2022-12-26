<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title><?php echo $pagetitle; ?></title>
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <header>
            <nav>
               <!-- Logo -->
               <img src="../images/logo.png" alt="Logo" class="logo">

                <!-- Search bar -->
               <form action="search.php" method="get">
                  <input type="text" name="search" placeholder="Search">
                  <input type='hidden' name='action' value='search'>
                  <button type="submit" name="submit-search">Search</button>
               </form>
               <!-- Connect button -->
               <a href="connect.php" class="connect">Connect</a>
               <!-- Cart button -->
               <a href="cart.php" class="cart">Cart</a>
            </nav>
      </header>
      <wrap>
      <main>
          <?php
          require __DIR__ . "/{$cheminVueBody}";
          ?>
      </main>
      </wrap>
      <footer>
          <div class="foot-container">
              <div class="foot-left">

                      <img src="../images/logo.png" alt="Logomini" class="logomini">


              <div class="logo-Fuzzy">
                  <h2>Fuzzy</h2>
                  <ul>
                        <li><a href="#">A propos</a></li>
                        <li><a href="#">Contactez nous</a></li>
              </div>
                  </ul>
              </div>
                <div class="foot-leftcenter">
                    <h2>Produits</h2>
                    <ul>
                        <li><a href="#"> Page Principale</a></li>
                        <li><a href="#">Modele 3D</a></li>
                        <li><a href="#">Accessoires</a></li>
                        <li><a href="#">Projectiles</a></li>
                    </ul>
                </div>
              <div class="foot-center">
                    <h2>Support</h2>
                    <ul>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Aide</a></li>
                            <li><a href="#">Livraison</a></li>
                    </ul>
              </div>
              <div class="foot-rightcenter">
                    <h2>Mon compte</h2>
                    <ul>
                            <li><a href="#">Mon compte</a></li>
                            <li><a href="#">Mes commandes</a></li>
                            <li><a href="#">Mes retours</a></li>
                            <li><a href="#">Mes informations</a></li>
                    </ul>
              </div>

              <div class="foot-right-right">
                  <h2>Ressources</h2>
                    <ul>
                        <li><a href="#">Feedbacks</a></li>
                        <li><a href="#">Sécurité</a></li>
                        <li><a href="#">Licence vente</a></li>
              </div>
              <div class="foot-right-right-right">
                    <h2>Conditions</h2>
                        <ul>
                            <li><a href="#">CGV</a></li>
                            <li><a href="#">CGU</a></li>
                            <li><a href="#">Politique de confidentialité</a></li>
                            <li><a href="#">Cookies</a></li>
                            <li><a href="#">Retour</a></li>
                            <li><a href="#">Livraison</a></li>
              </div>
            </div>
          <div class="foot-bottom">
              <p>© 2022 Fuzzy, Inc. All rights reserved.</p>
            </div>
      </footer>
   </body>
</html>