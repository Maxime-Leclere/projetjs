(function () {
    "use strict";
    $(() => {
        $('#message').fadeOut();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize()
        })
        .done(function (data) {
            if (data.hasOwnProperty('success') {
                if (data.success === true) {
                    window.location.href = '/';
                } else {
                    $('#message').html(data.message).fadeIn();
                }
            } else {
                // should never happen!!!

            }
        })
        .fail(function () {
            $('body').html("une erreur critique est arrivée")
        });
        return false;
    });
})();
