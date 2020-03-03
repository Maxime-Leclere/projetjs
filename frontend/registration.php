<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php require_once 'head.php' ?>
    </head>
    <body>
        <?php require_once 'header.php'?>
        <main id="main">
            <h1>Inscription</h1>
            <form id="form_registration" action="../backend/json/registrationjs.php" method="post">
                <label>Login</label>
                <input type="text" name="login" required/><br>
                <label>Password</label>
                <input type="password" name="password" required/><br>
                <input type="submit"/>
            </form>
            <a href="login.php">Vous avez un compte? Connectez-vous ici.</a>
        </main>
    </body>
</html>
