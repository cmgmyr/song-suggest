$(function () {
    $('form.delete-confirm').submit(function () {
        return userConfirmation($(this));
    });

    $('a.delete-confirm').click(function () {
        return userConfirmation($(this));
    });
});

function userConfirmation(element) {
    var alertText = $(element).data('confirm');
    return confirm(alertText);
}