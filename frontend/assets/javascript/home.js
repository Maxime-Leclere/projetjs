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
                                    $('<button>Rechercher</button>'),
                                    $('<button>Créer ingredient</button>'),
                                    $('<button>Créer unité</button>'),
                                    $('<button>Créer cocktail</button>'));
                    $.ajax({
                        url: '/backend/json/allCocktail.php',
                        method: 'get'
                    })
                    .done(function (data) {
                        if (data.hasOwnProperty('cocktail')) {
                            if (data.cocktail.length != 0) {
                                console.log("cocktail > 0");
                                for (let cocktail in data.cocktail) {
                                    let recipeDiv = $('<div id="recipe'+ data.cocktail[recipe][0] +'"></div>')
                                        .append($('<h2>'+ data.cocktail[recipe][1] +'</h2>'));
                                    $('#list_cocktail').append(recipeDiv);
                                }

                            } else {
                                $("#list_cocktail").html("Aucune recette de cocktail est enregistrée");
                            }
                        } else {
                            $("#list_cocktail").html("recipe n'existe pas. donc bug à corriger");

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
