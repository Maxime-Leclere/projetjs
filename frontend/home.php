<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php require_once 'head.php' ?>
        <script src="assets/javascript/unit.js"></script>
        <script src="assets/javascript/ingredient.js"></script>
        <script src="assets/javascript/home.js"></script>
    </head>
    <body>
        <?php require_once 'header.php'?>
        <main id="main">
            <div id="form_home">
                <form class="form_home" id="form_ingr" action="../backend/json/insertIngr.php" method="post">
                    <h1>Nouvel Ingrédient</h1>
                    <label>Description</label>
                    <input type="text" name="description_I">
                    <input type="submit" value="Envoyer">
                    <p id="message_ingredient"></p>
                </form>
                <form class="form_home" id="form_unit" action="../backend/json/insertUnit.php" method="post">
                    <h1>Nouvel Unité</h1>
                    <label>Description</label>
                    <input type="text" name="description_U">
                    <input type="submit" value="Envoyer">
                    <p id="message_unit"></p>
                </form>
                <form class="form_home" id="form_cocktail" action="../backend/json/qq.php" method="post">
                    <h1>Nouveau Cocktail</h1>
                    <label>Titre</label>
                    <input type="text" name="title"><br>
                    <label>Résumé</label>
                    <input type="text" name="description_C"><br>
                    <label>Description</label>
                    <textarea name="detail"></textarea><br>
                    <ul id="listIngredient"></ul><br>
                    <input type="hidden" name"quantityIng" value"1">
                    <button type="button" id="buttonplus">+</button>
                    <input type="submit" value="Envoyer">
                    <p id="message_cocktail"></p>
                </form>
            </div>
            <div id="list_cocktail"></div>
        </main>
    </body>
</html>
