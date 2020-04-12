class ListCocktail {
    constructor() {

    }

    refreshListCocktail() {
        $('#list_cocktail').empty();
        $.ajax({
            url: '/backend/json/allCocktail.php',
            method: 'get'
        })
        .done(function (data) {
            if (data.hasOwnProperty('cocktail')) {
                if (data.cocktail.length != 0) {
                    let listCocktail = new Array();
                    for (let cocktail in data.cocktail) {
                        listCocktail.push(new Cocktail(data.cocktail[cocktail][0],
                            data.cocktail[cocktail][1], data.cocktail[cocktail][2],
                            data.cocktail[cocktail][3]));
                    }
                    console.log("cocktail > 0");
                    for (let cocktail in listCocktail) {
                        let recipeDiv = $('<div class="recipe" id="recipe'+ listCocktail[cocktail].getId() +'"></div>')
                            .append($('<h2>'+ listCocktail[cocktail].getTitle() +'</h2>'))
                            .one('click', function () {
                                $.ajax({
                                    url: '/backend/json/getRecipe.php',
                                    method: 'post',
                                    data: { idrecipe: listCocktail[cocktail].getId() }
                                })
                                .done(function (dataC) {
                                    if (dataC.hasOwnProperty('recipe')) {
                                        let listIngredient = $('<ul/>');
                                        let list = dataC.recipe[1].ingredients;
                                        let listIngRecipe = new Array();
                                        for (let ing in list) {
                                            listIngRecipe.push(new Ingredient(list[ing][0][0],
                                                list[ing][0][1]), new Unit(list[ing][1][0],
                                                list[ing][1][1]), list[ing][2]);
                                        }
                                        for (let ingredient in listIngRecipe) {
                                            listIngredient.append($('<li/>').html(listIngRecipe[ingredient][0].getName() +
                                                " : " + listIngRecipe[ingredient][2] + " " +
                                                listIngRecipe[ingredient][1].getName()));
                                        }
                                        $('#recipe'+ listCocktail[cocktail].getId())
                                            .append($('<p>'+ listCocktail[cocktail].getDescription() +'</p>'),
                                                $('<p>'+ listCocktail[cocktail].getDetail() +'</p>'),
                                                listIngredient);
                                    }
                                })
                                .fail(function () {
                                    $('#recipe'+ listCocktail[cocktail].getId())
                                        .html("une erreur critique est arrivée");

                                });
                            });
                        $('#list_cocktail').append(recipeDiv);
                        if (cocktail != listCocktail.length-1)
                            $('#list_cocktail').append($('<hr>'));
                    }

                } else {
                    $("#list_cocktail")
                        .html("Aucune recette de cocktail est enregistrée");
                }
            } else {
                $("#list_cocktail")
                    .html("cocktail n'existe pas. donc bug à corriger");

            }
        })
        .fail(function () {
            $('body').html("une erreur critique est arrivée");
        });
    }

}
