(function () {
    "use strict";
    $(() => {
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).method('post'),
            data: $(this).serialize()
        })
        .done(function () {
            if (data.success == true) {
                window.location.href = '/';
            }
            // } else {
            //     $('#messages').html(data.message).fadeIn();
            // }
        })
        .fail(function () {
            $('body').html("une erreur critique est arrivée")
        });
        return false;
    });
})();
