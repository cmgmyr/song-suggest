$(function () {
    $('form.delete-confirm').submit(function () {
        return userConfirmation($(this));
    });

    $('a.delete-confirm').click(function () {
        return userConfirmation($(this));
    });

    $('#follow-checkbox').click(function () {
        $('form.follow-form').submit();
    });
});

function userConfirmation(element) {
    var alertText = $(element).data('confirm');
    return confirm(alertText);
}