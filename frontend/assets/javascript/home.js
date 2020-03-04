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
                        
                    })
                    .done(function () {

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
