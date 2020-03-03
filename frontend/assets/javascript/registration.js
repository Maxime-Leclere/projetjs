(function () {
    "use strict";
    $(() => {
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).method('post'),
            data: $(this).serialize()
        })
        .done(function () {

        })
        .fail(function () {

        });
        return false;
    });
})();
