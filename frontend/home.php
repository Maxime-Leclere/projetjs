<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php require_once 'head.php' ?>
    </head>
    <body>
        <?php require_once 'header.php'?>
        <main id="main">
            <div id="form_home">
                <form class="form_home" id="form_ingr" action="../backend/json/qq.php" method="post">
                    <h1>Nouvel Ingrédient</h1>
                    <label>Description</label>
                    <input type="text" name="description_I">
                    <input type="submit" value="Envoyer">
                </form>
                <form class="form_home" id="form_unit" action="../backend/json/qq.php" method="post">
                    <h1>Nouvel Unité</h1>
                    <label>Description</label>
                    <input type="text" name="description_U">
                    <input type="submit" value="Envoyer">
                </form>
                <form class="form_home" id="form_cocktail" action="../backend/json/qq.php" method="post">
                    <h1>Nouveau Cocktail</h1>
                    <label>Titre</label>
                    <input type="text" name="title"><br>
                    <label>Résumé</label>
                    <input type="text" name="description_C"><br>
                    <label>Description</label>
                    <textarea name="detail"></textarea><br>
                    <div id="listIngredient">
                        <ul id="listC"></ul>
                    </div><br>
                    <input type="submit" value="Envoyer">
                </form>
            </div>
            <div id="list_cocktail"></div>
        </main>
    </body>
    <script src="assets/javascript/home.js"></script>

</html>
