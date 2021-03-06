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
                    let listCocktail = new ListCocktail();
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
                                        $('#lineform').hide();
                                        $('#form_ingr').fadeIn();
                                        $('#lineform').fadeIn();
                                    }),
                                    $('<button>Créer Unité</button>').click(function () {
                                        $('.form_home').hide();
                                        $('#lineform').hide();
                                        $('#form_unit').fadeIn();
                                        $('#lineform').fadeIn();
                                    }),
                                    $('<button>Créer Cocktail</button>').click(function () {
                                        $('.form_home').hide();
                                        $('#lineform').hide();
                                        $('#listIngredient').empty();
                                        $('#quantityIng').attr("value", 1);
                                        $('#buttonplus').off('click');
                                        $('#buttonsuppr').off('click');
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
                                                    let count = 0;
                                                    console.log(count+ " apres initialiser");
                                                    let ingbalise = $('<li class="listitemIng" id="line'+count+'"></li>');
                                                    let inglist = $('<select id="inglist'+count+'" name="inglist'+count+'"></select>');
                                                    for (let ing in listI) {
                                                        inglist.append($('<option value="'+listI[ing].getId()+'">'+ listI[ing].getName()+'</option>'));
                                                    }
                                                    let unitlist = $('<select id="listunite'+count+'" name="unitList'+count+'"></select>');
                                                    for (let uni in listU) {
                                                        unitlist.append($('<option value="'+listU[uni].getId()+'">'+ listU[uni].getName()+'</option>'));
                                                    }
                                                    let text = $('<input type="text" id="edit_text'+count+'" name="quantity'+count+'" maxlength="4" size="1" pattern="\\d*" title="Seulement des chiffres" required>');

                                                    ingbalise.append(inglist, text, unitlist);
                                                    $('#listIngredient').append(ingbalise);
                                                    count++;
                                                    console.log(count + " apres une fois");

                                                    $('#buttonplus').on('click', function () {
                                                        console.log(count + " dans debut function click");
                                                        let ingbalise2 = $('<li class="listitemIng" id="line'+count+'"></li>');
                                                        let inglist2 = $('<select id="inglist'+count+'" name="inglist'+count+'"></select>');
                                                        for (let ing in listI) {
                                                            inglist2.append($('<option value="'+listI[ing].getId()+'">'+ listI[ing].getName()+'</option>'));
                                                        }
                                                        let unitlist2 = $('<select id="listunite'+count+'" name="unitList'+count+'"></select>');
                                                        for (let uni in listU) {
                                                            unitlist2.append($('<option value="'+listU[uni].getId()+'">'+ listU[uni].getName()+'</option>'));
                                                        }
                                                        let text2 = $('<input type="text" id="edit_text'+count+'" name="quantity'+count+'" maxlength="4" size="1" pattern="\\d*" title="Seulement des chiffres" required>');

                                                        ingbalise2.append(inglist2, text2, unitlist2);
                                                        $('#listIngredient').append(ingbalise2);
                                                        console.log(count + " dans apres function click");

                                                        count = count+1;
                                                        $('#quantityIng').attr("value", count)
                                                    });
                                                    $('#buttonsuppr').on('click', function () {
                                                        let quantityInginter = $('#quantityIng').attr("value");
                                                        quantityInginter++;
                                                        for (let i = 1; i < quantityInginter; i++) {
                                                            $('#line'+i).remove();
                                                        }
                                                        count = 1;
                                                        $('#quantityIng').attr("value", 1);
                                                    });
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
                                        $('#lineform').fadeIn();
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
                            $('#form_unit').html("une erreur critique est arrivée");
                        });

                        return false;
                    });
                    $('#form_cocktail').submit(function () {
                        $('#message_cocktail').fadeOut();
                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: $(this).serialize()
                        })
                        .done(function (data) {
                            if (data.hasOwnProperty('success')) {
                                if (data.success === true) {
                                    listCocktail.refreshListCocktail();
                                } else {$("#message_cocktail").html(data.error).fadeIn();}
                            }
                        })
                        .fail(function () {
                            $('#form_cocktail').html("une erreur critique est arrivée");
                        });

                        return false;
                    });
                    $('.form_home').hide();
                    $('#lineform').hide();
                    listCocktail.refreshListCocktail();

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
