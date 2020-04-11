(function () {
    "use strict";
    $(() => {
        $.ajax({
            url: '/backend/json/is_connectedjs.php',
            method: 'get'
        })
        .done(function (data) {
            if (data.hasOwnProperty('success')) {
                if (data.success === true) {
                    $('header').append($('<button>Déconnexion</button>')
                                            .click(function () {
                                                $.ajax({
                                                    url: '/backend/json/logoutjs.php',
                                                    method: 'get'
                                                })
                                                .done(function () {
                                                    window.location.href = '/frontend/login.php';
                                                })
                                                .fail(function () {
                                                    $('body').html("une erreur critique est arrivée");
                                                });
                                            }),
                                    $('<button>Créer Ingrédient</button>').click(function () {
                                        $('.form_home').hide();
                                        $('#form_ingr').fadeIn();
                                    }),
                                    $('<button>Créer Unité</button>').click(function () {
                                        $('.form_home').hide();
                                        $('#form_unit').fadeIn();
                                    }),
                                    $('<button>Créer Cocktail</button>').click(function () {
                                        $('.form_home').hide();
                                        $('#listIngredient').empty();
                                        $('#quantityIng').attr("value", 1)
                                        $.ajax({
                                            url: '/backend/json/allIngUnit.php',
                                            method: 'get'
                                        })
                                        .done(function (data) {
                                            if (data.hasOwnProperty('list')) {
                                                if (data.list.ingredient.length != 0 || data.list.unite.length != 0) {
                                                    let listI = new Array();
                                                    let listU = new Array();

                                                    for (let item in data.list.ingredient) {
                                                        listI.push(new Ingredient(data.list.ingredient[item][0], data.list.ingredient[item][1]));
                                                    }
                                                    for (let item in data.list.unite) {
                                                        listU.push(new Unit(data.list.unite[item][0], data.list.unite[item][1]));
                                                    }
                                                    console.log(listI);
                                                    console.log(listU);

                                                    let i = 0;
                                                    let makeIngBalise = function (listI, listU) {
                                                        let ingbalise = $('<li class="listitemIng" id="line'+i+'"></li>');
                                                        let inglist = $('<select id="inglist'+i+'" name="inglist'+i+'"></select>');
                                                        for (let ing in listI) {
                                                            inglist.append($('<option value="'+listI[ing].getId()+'">'+ listI[ing].getName()+'</option>'));
                                                        }
                                                        let unitlist = $('<select id="listunite'+i+'" name="unite'+i+'"></select>');
                                                        for (let uni in listU) {
                                                            unitlist.append($('<option value="'+listU[uni].getId()+'">'+ listU[uni].getName()+'</option>'));
                                                        }
                                                        let text = $('<input type="text" id="edit_text'+i+'" name="quantity'+i+'" maxlength="4" size="1" pattern="\\d*" title="Seulement des chiffres">');

                                                        ingbalise.append(inglist, text, unitlist);
                                                        $('#listIngredient').append(ingbalise);

                                                        i = i+1;
                                                    }
                                                    $('#buttonplus').click(function () {
                                                        makeIngBalise(listI, listU);
                                                        $('#quantityIng').attr("value", i)
                                                    });
                                                    makeIngBalise(listI, listU);
                                                    // for (let ing in listI) {
                                                    //     let ingbalise = $('<li class="listitemIng" id"line'+i+'"></li>');
                                                    //     let checkbox = $('<input type="checkbox" id="checkIng'+i+'" name="check'+i+'">');
                                                    //     let nameIng = $('<label for"checkIng">'+listI[ing].getName()+'</label>');
                                                    //     let idhide = $('<input type="hidden" name"idIng'+i+'" value"'+listI[ing].getId()+'">');
                                                    //     let text = $('<input type="text" id="edit_text'+i+'" name="quantity'+i+'" maxlength="4" size="1" pattern="\\d*" title="Seulement des chiffres">');
                                                    //     let unitlist = $('<select id="listunite'+i+'" name="unite'+i+'"></select>');
                                                    //     for (let uni in listU) {
                                                    //         unitlist.append($('<option value="'+listU[uni].getId()+'">'+ listU[uni].getName()+'</option>'));
                                                    //     }
                                                    //     ingbalise.append(checkbox, nameIng, idhide, text, unitlist);
                                                    //     $('#listIngredient').append(ingbalise);
                                                    //     ++i;
                                                    // }
                                                } else {
                                                    console.log(data.list.length);
                                                    $('#listIngredient').html("Il y a pas d'unité ou d'ingredient");
                                                }
                                            } else {
                                                //// TODO:
                                            }
                                        })
                                        .fail(function () {
                                            $('#form_cocktail').html("une erreur critique est arrivée");
                                        });
                                        $('#form_cocktail').fadeIn();
                                    }));
                    $('#form_ingr').submit(function () {
                        $('#message_ingredient').fadeOut();
                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: $(this).serialize()
                        })
                        .done(function (data) {
                            if (data.hasOwnProperty('success')) {
                                if (data.success === true) {

                                } else {$("#message_ingredient").html(data.error).fadeIn();}
                            }
                        })
                        .fail(function () {
                            $('#form_ingr').html("une erreur critique est arrivée");
                        });

                        return false;
                    });
                    $('#form_unit').submit(function () {
                        $('#message_unit').fadeOut();
                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: $(this).serialize()
                        })
                        .done(function (data) {
                            if (data.hasOwnProperty('success')) {
                                if (data.success === true) {

                                } else {$("#message_unit").html(data.error).fadeIn();}
                            }
                        })
                        .fail(function () {
                            $('#form_ingr').html("une erreur critique est arrivée");
                        });

                        return false;
                    });
                    $('.form_home').hide();
                    $.ajax({
                        url: '/backend/json/allCocktail.php',
                        method: 'get'
                    })
                    .done(function (data) {
                        if (data.hasOwnProperty('cocktail')) {
                            if (data.cocktail.length != 0) {
                                console.log("cocktail > 0");
                                for (let cocktail in data.cocktail) {
                                    let recipeDiv = $('<div class="recipe" id="recipe'+ data.cocktail[cocktail][0] +'"></div>')
                                        .append($('<h2>'+ data.cocktail[cocktail][1] +'</h2>'))
                                        .one('click', function () {
                                            $.ajax({
                                                url: '/backend/json/getRecipe.php',
                                                method: 'post',
                                                data: { idrecipe: data.cocktail[cocktail][0] }
                                            })
                                            .done(function (dataC) {
                                                if (dataC.hasOwnProperty('recipe')) {
                                                    let listIngredient = $('<ul/>');
                                                    let list = dataC.recipe[1].ingredients;
                                                    for (let ingredient in list) {
                                                        listIngredient.append($('<li/>').html(list[ingredient][0][1] +
                                                            " : " + list[ingredient][2] + " " +
                                                            list[ingredient][1][1]));
                                                    }
                                                    $('#recipe'+ data.cocktail[cocktail][0])
                                                        .append($('<p>'+ data.cocktail[cocktail][2] +'</p>'),
                                                            $('<p>'+ data.cocktail[cocktail][3] +'</p>'),
                                                            listIngredient);
                                                }
                                            })
                                            .fail(function () {
                                                $('#recipe'+ data.cocktail[cocktail][0])
                                                    .html("une erreur critique est arrivée");

                                            });
                                        });
                                    $('#list_cocktail').append(recipeDiv);
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
                } else {
                    window.location.href = '/frontend/login.php';
                }
            } else {
                // should never happen!!!

            }
        })
        .fail(function () {
            $('body').html("une erreur critique est arrivée");
        });
    });
})();
