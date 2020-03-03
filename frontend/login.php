<!DOCTYPE html>
<html lang="fr">
    <head>
        <?= require_once 'head.php' ?>
        <script src="assets/javascript/login.js"></script>
    </head>
    <body>
        <?= require_once 'header.php'?>
        <main id="main">
            <h1>Connexion</h1>
            <form id="form_login" action="../backend/json/loginjs.php" method="post">
                <label>Login</label>
                <input type="text" name="login" required/>
                <label>Password</label>
                <input type="password" name="password" required/>
                <input type="submit"/>
                <a href="registration.php">Vous n'avez pas de compte? Inscriver-vous ici.</a>
            </form>
        </main>
    </body>
</html>
