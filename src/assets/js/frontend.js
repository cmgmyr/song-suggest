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

    $('#artist').typeahead({
        name: 'bands',
        source: function(q) {
            var returnData, data;
            data = {q : q};

            $.ajax({
                dataType: "json",
                url: '/api/bands',
                data: data,
                async: false,
                success: function(response) {
                    returnData = response.data;
                }
            });

            return returnData;
        }
    });
});

function userConfirmation(element) {
    var alertText = $(element).data('confirm');
    return confirm(alertText);
}