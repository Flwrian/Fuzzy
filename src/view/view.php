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
               <form action="search.php" method="post">
                  <input type="text" name="search" placeholder="Search">
                  <button type="submit" name="submit-search">Search</button>
               </form>
               <!-- Connect button -->
               <a href="connect.php" class="connect">Connect</a>
               <!-- Cart button -->
               <a href="cart.php" class="cart">Cart</a>
            </nav>
      </header>
      <main>
            <?php
            require __DIR__ . "/{$cheminVueBody}";
            ?>
      </main>
      <footer>
        <p>Site de Covoiturage par <span>Florian Montourcy</span></p>
      </footer>
   </body>
</html>