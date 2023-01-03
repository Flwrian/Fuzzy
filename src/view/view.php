<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title><?php echo $pagetitle; ?></title>
      <link rel="stylesheet" href="../web/style.css">
       <link rel="stylesheet" href="../web/connection.css">
       <link rel="stylesheet" href="../web/detail.css">
         <link rel="stylesheet" href="../web/create.css">
   </head>
   <body>
      <header>

            <nav>
               <!-- Logo in a -->
                <a href="frontController.php" class="logo">
                    <img src="../images/logo.png" alt="Logo" class="logo">
                </a>



               <!-- Search bar -->
               <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-search-11" viewBox="0 0 40 40">
                    <path d="M15.553 31.106c8.59 0 15.553-6.963 15.553-15.553S24.143 0 15.553 0 0 6.963 0 15.553s6.963 15.553 15.553 15.553zm0-3.888c6.443 0 11.665-5.222 11.665-11.665 0-6.442-5.222-11.665-11.665-11.665-6.442 0-11.665 5.223-11.665 11.665 0 6.443 5.223 11.665 11.665 11.665zM27.76 31.06c-.78-.78-.778-2.05.004-2.833l.463-.463c.783-.783 2.057-.78 2.834-.003l8.168 8.17c.782.78.78 2.05-.003 2.832l-.463.463c-.783.783-2.057.78-2.833.003l-8.17-8.167z"
                    fill-rule="evenodd" />
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-clear-2" viewBox="0 0 20 20">
                    <path d="M8.96 10L.52 1.562 0 1.042 1.04 0l.522.52L10 8.96 18.438.52l.52-.52L20 1.04l-.52.522L11.04 10l8.44 8.438.52.52L18.96 20l-.522-.52L10 11.04l-8.438 8.44-.52.52L0 18.96l.52-.522L8.96 10z" fill-rule="evenodd" />
                </symbol>
                </svg>
                <form method="get" action="frontController.php" class="searchbox sbx-amazon">
                <input type='hidden' name='action' value='search'>
                <div role="search" class="sbx-amazon__wrapper">
                    <input type="search" name="query" placeholder="Rechercher un article" autocomplete="off" required="required" class="sbx-amazon__input">
                    <button type="submit" title="Rechercher" class="sbx-amazon__submit">
                    <svg role="img" aria-label="Search">
                        <use xlink:href="#sbx-icon-search-11"></use>
                    </svg>
                    </button>
                    <button type="reset" title="Clear the search query." class="sbx-amazon__reset">
                    <svg role="img" aria-label="Reset">
                        <use xlink:href="#sbx-icon-clear-2"></use>
                    </svg>
                    </button>
                </div>
                </form>
                <script type="text/javascript">
                document.querySelector('.searchbox [type="reset"]').addEventListener('click', function() {  this.parentNode.querySelector('input').focus();});
                </script>



                <!-- Connect button en fonction de la session -->
                <?php
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $username = $user->getUsername();
                    echo '<a href="frontController.php?action=deconnection" class="connect">
                    <img src="../images/profile.png" alt="Se connecter" class="connectImage">
                    <span> ' . $username . '</span>
                </a>';
                } else {
                    echo '<a href="frontController.php?action=connection" class="connect">
                    <img src="../images/profile.png" alt="Se connecter" class="connectImage">
                    <span>Se connecter</span>
                </a>';
                }
                ?>

                <!-- Cart button -->
                <a href="frontController.php?action=readPanier" class="cart">
                     <img src="../images/cart.png" alt="Panier" class="cartImage">
                     <span>Panier</span>
                </a>

                <?php
                if (isset($_SESSION['user']) && $_SESSION['user']->getAdmin()){
                    echo "<a href=\"frontController.php?action=admin\" class=\"adminButton\">
                    <span>Administration</span>
                </a>";
                }
                ?>




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
