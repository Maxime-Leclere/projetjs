(function () {
    "use strict";
    alert("bonjour");
    $(() => {
        $('#form_registration').submit(function () {
            $('#message_login').fadeOut();
            $('#message_password').fadeOut();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).method('post'),
                data: $(this).serialize()
            })
            .done(function (data) {
                if (data.hasOwnProperty('success')) {
                    if (data.success === true) {
                        window.location.href = '/frontend/home.php';
                    } else {
                        for (let key in data.error) {
                            if (data.error.hasOwnProperty(key)) {
                                $(key).html(data.error[key]).fadeIn();
                            }
                        }
                    }
                } else {
                    // should never happen!!!

                }
            })
            .fail(function () {
                $('body').html("une erreur critique est arrivée");
            });
            return false;

        });
    });
})();
