<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bodyCo">
    <?php
    // Login or sign up form
    if (!isset($_SESSION['user'])) {
        echo '<form action="frontController.php?action=authenticate" method="post" class="loginForm">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Login">
        </form>';
    }
    // Logout form
    else {
        echo '<form action="frontController.php" method="post" class="logoutForm">
            <input type="submit" value="Logout">';
    }
    ?>
</body>
</html>
