<!DOCTYPE html>
<html lang="fr">
    <head>
        <?= require_once 'head.php' ?>
    </head>
    <body>
        <?= require_once 'header.php'?>
        <main id="main">
            <h1>Inscription</h1>
            <form id="form_registration" action="../backend/json/registrationjs.php" method="post">
                <label>Login</label>
                <input type="text" name="login" required/>
                <label>Password</label>
                <input type="password" name="password" required/>
                <input type="submit"/>
            </form>
            <a href="login.html">Vous avez un compte? Connectez-vous ici.</a>
        </main>
    </body>
</html>
